using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace TMA3a.part4
{
	public partial class cart : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			if (Request.QueryString["logout"] == "true")
			{
				Session.Clear();
				Session.Abandon();
				userDropdown.InnerHtml = $@"<a href=""/part4/login.aspx"" data-after=""log"">SignIn/LogIn</a>";
				return;
			}


			if (Session["username"] != null)
			{
				string user = Session["username"].ToString();
				userDropdown.InnerHtml = $@"
				<select class=""cta"" id=""userDropdown"" onchange=""handleUserAction(this)"">
					<option disabled selected>Hi, {user}</option>
					<option value=""profile"">Profile</option>
                    <option value=""cart"">Cart</option>
					<option value=""orders"">Orders</option>
					<option value=""logout"">Log Out</option>
				</select>";
			}
			else
			{
				Response.Redirect("login.aspx");
			}

			if (!IsPostBack)
				LoadCart();

			if (IsPostBack)
			{
				if (Request.Form["deleteCookie"] != null)
				{
					string cookieToDelete = HttpUtility.UrlDecode(Request.Form["deleteCookie"]);
					if (Request.Cookies[cookieToDelete] != null)
					{
						HttpCookie original = Request.Cookies[cookieToDelete];

						HttpCookie expired = new HttpCookie(cookieToDelete);
						expired.Expires = DateTime.Now.AddDays(-1);

						expired.Path = original.Path ?? "/part4";

						Response.Cookies.Add(expired);
					}
					LoadCart();
				}
				else if (Request.Form["editCookie"] != null)
				{
					string cookieToEdit = HttpUtility.UrlDecode(Request.Form["editCookie"]);
					HttpCookie cookie = Request.Cookies[cookieToEdit];

					if (cookie != null)
					{
						Session["EditCookie"] = cookie.Values;
						Response.Redirect("custom.aspx");

						return;
					}
				}
			}
		}
		private void LoadCart()
		{
			litOrders.InnerHtml = "";
			var allCookies = Request.Cookies.AllKeys;
			var html = new System.Text.StringBuilder();

			bool foundOrders = false;
			decimal totalPrice = 0;

			string connStr = System.Configuration.ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;

			using (SqlConnection conn = new SqlConnection(connStr))
			{
				conn.Open();

				int orderNum = 1;
				foreach (string cookieName in allCookies)
				{
					if (!cookieName.StartsWith("CartItem")) continue;

					HttpCookie cartCookie = Request.Cookies[cookieName];
					if (cartCookie == null) continue;

					foundOrders = true;

					string pcId = cartCookie.Values["ComputerId"];
					string cpuId = cartCookie.Values["CPU"];
					string displayId = cartCookie.Values["Display"];
					string hddId = cartCookie.Values["HDD"];
					string ramId = cartCookie.Values["RAM"];
					string soundId = cartCookie.Values["Sound"];
					string priceStr = cartCookie.Values["Price"];
					decimal price = decimal.TryParse(priceStr, out decimal parsed) ? parsed : 0;
					totalPrice += price;

					// Fetch names
					string pcName = GetPCName(conn, pcId);
					string cpuName = GetCompName(conn, cpuId);
					string displayName = GetCompName(conn, displayId);
					string hdName = GetCompName(conn, hddId);
					string ramName = GetCompName(conn, ramId);
					string soundName = GetCompName(conn, soundId);
					string encodedCookieName = HttpUtility.UrlEncode(cookieName);

					html.Append("<div class='order'>");
					html.AppendFormat("<h3>Order #{0}</h3>", orderNum++);
					html.AppendFormat("<p><strong>PC:</strong> {0}</p>", pcName);
					html.AppendFormat("<p><strong>Cost:</strong> ${0}</p>", price);
					html.AppendFormat("<p><strong>CPU:</strong> {0}</p>", cpuName);
					html.AppendFormat("<p><strong>Display:</strong> {0}</p>", displayName);
					html.AppendFormat("<p><strong>Hard Drive:</strong> {0}</p>", hdName);
					html.AppendFormat("<p><strong>RAM:</strong> {0}</p>", ramName);
					html.AppendFormat("<p><strong>Sound Card:</strong> {0}</p>", soundName);
					html.AppendFormat(@"
					<form method='post' style='display:inline;'>
						<input type='hidden' name='deleteCookie' value='{0}' />
						<button type='submit' class='cta'>Delete</button>
					</form>
					<form method='post' style='display:inline;'>
						<input type='hidden' name='editCookie' value='{0}' />
						<button type='submit' class='cta'>Edit</button>
					</form>", encodedCookieName);
					html.Append("</div>");

					

					
				}
			}

			if (foundOrders)
			{
				litOrders.InnerHtml = html.ToString();
				TotalPrice.Text = $"Total Price: ${totalPrice:F2}";
			}
			else
			{	
				litOrders.InnerHtml = "<div class='order'><p>Sorry, nothing to see here yet. You are always welcome to buy one of our PC's! :)</p></div>";
				TotalPrice.Text = "-";
			}
		}

		private string GetPCName(SqlConnection conn, string pcId)
		{
			using (SqlCommand cmd = new SqlCommand("SELECT Name FROM PCs WHERE Id = @id", conn))
			{
				cmd.Parameters.AddWithValue("@id", pcId);
				return cmd.ExecuteScalar()?.ToString() ?? "Unknown PC";
			}
		}

		private string GetCompName(SqlConnection conn, string compId)
		{
			using (SqlCommand cmd = new SqlCommand("SELECT Name FROM Comps WHERE Id = @id", conn))
			{
				cmd.Parameters.AddWithValue("@id", compId);
				return cmd.ExecuteScalar()?.ToString() ?? "Unknown Component";
			}
		}

		protected void Pay_Click(object sender, EventArgs e)
		{
			var allCookies = Request.Cookies.AllKeys;
			int userId = Convert.ToInt32(Session["UserId"]);
			string address = AddressBox.Text.Trim();
			decimal cardNo = Convert.ToDecimal(CreditCardBox.Text.Trim());

			string connStr = System.Configuration.ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;

			using (SqlConnection conn = new SqlConnection(connStr))
			{
				conn.Open();

				foreach (string cookieName in allCookies)
				{
					if (!cookieName.StartsWith("CartItem")) continue;

					HttpCookie cartCookie = Request.Cookies[cookieName];
					if (cartCookie == null) continue;

					int newId = 1;
					using (SqlCommand getMaxIdCmd = new SqlCommand("SELECT ISNULL(MAX(Id), 0) + 1 FROM Users", conn))
					{
						newId = (int)getMaxIdCmd.ExecuteScalar();
					}

					string pcId = cartCookie.Values["ComputerId"];
					string cpuId = cartCookie.Values["CPU"];
					string displayId = cartCookie.Values["Display"];
					string hddId = cartCookie.Values["HDD"];
					string ramId = cartCookie.Values["RAM"];
					string soundId = cartCookie.Values["Sound"];
					string price = cartCookie.Values["Price"];

					string sql = @"INSERT INTO Orders (Id, User_ID, PC_ID, CPU_ID, Display_ID, HD_ID, RAM_ID, Sound_ID, Address, CardNo, Price)
                           VALUES (@Id, @UserId, @PC_ID, @CPU_ID, @Display_ID, @HD_ID, @RAM_ID, @Sound_ID, @Address, @CardNo, @Price)";

					using (SqlCommand cmd = new SqlCommand(sql, conn))
					{
						cmd.Parameters.AddWithValue("@Id", newId);
						cmd.Parameters.AddWithValue("@UserId", userId);
						cmd.Parameters.AddWithValue("@PC_ID", pcId);
						cmd.Parameters.AddWithValue("@CPU_ID", cpuId);
						cmd.Parameters.AddWithValue("@Display_ID", displayId);
						cmd.Parameters.AddWithValue("@HD_ID", hddId);
						cmd.Parameters.AddWithValue("@RAM_ID", ramId);
						cmd.Parameters.AddWithValue("@Sound_ID", soundId);
						cmd.Parameters.AddWithValue("@Address", address);
						cmd.Parameters.AddWithValue("@CardNo", cardNo);
						cmd.Parameters.AddWithValue("@Price", price);
						cmd.ExecuteNonQuery();
					}

					cartCookie.Expires = DateTime.Now.AddDays(-1);
					Response.Cookies.Add(cartCookie);
				}
			}

			Response.Redirect("Orders.aspx");
		}
	}
}
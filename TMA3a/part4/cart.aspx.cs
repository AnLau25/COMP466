using System;
using System.Collections.Generic;
using System.Configuration;
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
		string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;
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
			{
				LoadCart();
			}
		}
		private void LoadCart()
		{
			List<CartItem> cartItems = new List<CartItem>();
			HttpCookieCollection cookies = Request.Cookies;

			foreach (string key in cookies.AllKeys)
			{
				if (key != null && key.StartsWith("CartItem"))
				{
					HttpCookie cookie = cookies[key];
					var query = HttpUtility.ParseQueryString(cookie.Value);
					if (Session["username"].ToString() == query["UserName"])
					{
						CartItem item = new CartItem
						{
							CookieName = key,
							PCName = GetPCName(query["ComputerId"]),
							CPU = GetCompName(query["CPU"]),
							Display = GetCompName(query["Display"]),
							HD = GetCompName(query["HDD"]),
							RAM = GetCompName(query["RAM"]),
							Sound = GetCompName(query["Sound"]),
							Price = query["Price"]
						};
						cartItems.Add(item);
					}		
				}
			}
			CartRepeater.DataSource = cartItems;
			CartRepeater.DataBind();

			Pay.Visible = cartItems.Count > 0;
			LblNoItems.Visible = cartItems.Count == 0;
		}

		protected void CartRepeater_ItemCommand(object source, RepeaterCommandEventArgs e)
		{
			string cookieName = e.CommandArgument.ToString();

			if (e.CommandName == "Delete")
			{
				if (Request.Cookies[cookieName] != null)
				{
					HttpCookie expired = new HttpCookie(cookieName);
					expired.Expires = DateTime.Now.AddDays(-1);
					expired.Path = "/part4";
					Response.Cookies.Add(expired);
				}
				Response.Redirect("cart.aspx");
			}
			else if (e.CommandName == "Edit")
			{
				Response.Redirect("custom.aspx?cookie=" + cookieName);
			} 
		}


		private string GetPCName(string pcId)
		{
			using (SqlConnection conn = new SqlConnection(connStr))
			using (SqlCommand cmd = new SqlCommand("SELECT Name FROM PCs WHERE Id = @id", conn))
			{
				conn.Open();
				cmd.Parameters.AddWithValue("@id", pcId);
				return cmd.ExecuteScalar()?.ToString() ?? "Unknown PC";
			}
		}

		private string GetCompName(string compId)
		{
			using (SqlConnection conn = new SqlConnection(connStr))
			using (SqlCommand cmd = new SqlCommand("SELECT Name FROM Comps WHERE Id = @id", conn))
			{
				conn.Open();
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

			using (SqlConnection conn = new SqlConnection(connStr))
			{
				conn.Open();

				foreach (string cookieName in allCookies)
				{
					if (!cookieName.StartsWith("CartItem")) continue;

					HttpCookie cartCookie = Request.Cookies[cookieName];
					if (cartCookie == null) continue;

					int newId = 1;
					using (SqlCommand getMaxIdCmd = new SqlCommand("SELECT ISNULL(MAX(Id), 0) + 1 FROM Orders", conn))
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
					cartCookie.Path = "/part4";
					Response.Cookies.Add(cartCookie);
				}
			}

			Response.Redirect("Orders.aspx");
		}

		public class CartItem
		{
			public string CookieName { get; set; }
			public string PCName { get; set; }
			public string Display { get; set; }
			public string CPU { get; set; }
			public string RAM { get; set; }
			public string HD { get; set; }
			public string Sound { get; set; }
			public string Price { get; set; }
		}
	}
}

/*
For more detailed cookie attributes (including paths), navigate to the "Application" tab or "Storage" 
in your browser's developer tools. There, you can view cookies and their attributes such as Path, 
Domain, and Expiration.
 */
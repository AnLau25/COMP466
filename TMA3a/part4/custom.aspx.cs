using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace TMA3a.part4
{
	public partial class custom : System.Web.UI.Page
	{
		string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;
		int computerId;
		decimal basePrice = 0;
		protected void Page_Load(object sender, EventArgs e)
		{
			if (Request.QueryString["logout"] == "true")
			{
				Session.Clear();
				Session.Abandon();
				userDropdown.InnerHtml = $@"<a href=""/part4/login.aspx"" data-after=""cart"">SignIn/LogIn</a>";
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
				if (int.TryParse(Request.QueryString["pc"], out computerId))
				{
					LoadComputerInfo(computerId);
					LoadComponentDropdowns(computerId);
					UpdatePrice();
				}
			}

			CPUDropDown.SelectedIndexChanged += Component_Changed;
			DisplayDropDown.SelectedIndexChanged += Component_Changed;
			HDDropDown.SelectedIndexChanged += Component_Changed;
			RAMDropDown.SelectedIndexChanged += Component_Changed;
			SoundDropDown.SelectedIndexChanged += Component_Changed;

			CPUDropDown.AutoPostBack = true;
			DisplayDropDown.AutoPostBack = true;
			HDDropDown.AutoPostBack = true;
			RAMDropDown.AutoPostBack = true;
			SoundDropDown.AutoPostBack = true;
		}

		private void LoadComputerInfo(int id)
		{
			using (SqlConnection conn = new SqlConnection(connStr))
			{
				string query = "SELECT Name, BasePrice FROM PCs WHERE Id = @id";
				SqlCommand cmd = new SqlCommand(query, conn);
				cmd.Parameters.AddWithValue("@id", id);

				conn.Open();
				SqlDataReader reader = cmd.ExecuteReader();
				if (reader.Read())
				{
					Computer.Text = reader["Name"].ToString();
					basePrice = Convert.ToDecimal(reader["BasePrice"]);
				}
				conn.Close();
			}
		}

		private void LoadComponentDropdowns(int id)
		{
			LoadDropdown("CPU", CPUDropDown, id);
			LoadDropdown("Display", DisplayDropDown, id);
			LoadDropdown("Hard Drive", HDDropDown, id);
			LoadDropdown("RAM", RAMDropDown, id);
			LoadDropdown("Sound Card", SoundDropDown, id);
		}

		private void LoadDropdown(string type, System.Web.UI.WebControls.DropDownList ddl, int pcId)
		{
			ddl.Items.Clear();

			using (SqlConnection conn = new SqlConnection(connStr))
			{
				string query = @"
                SELECT C.Id, C.Name + ' ($' + CAST(C.Price AS VARCHAR) + ')' AS Display
                FROM Comps C
                INNER JOIN Compat CMP ON C.Id = CMP.Comp_ID
                WHERE CMP.PC_ID = @pcId AND C.Type = @type";

				SqlCommand cmd = new SqlCommand(query, conn);
				cmd.Parameters.AddWithValue("@pcId", pcId);
				cmd.Parameters.AddWithValue("@type", type);

				conn.Open();
				SqlDataReader reader = cmd.ExecuteReader();
				while (reader.Read())
				{
					ddl.Items.Add(new System.Web.UI.WebControls.ListItem(reader["Display"].ToString(), reader["Id"].ToString()));
				}
				conn.Close();
			}
		}

		private decimal GetComponentPrice(int compId)
		{
			using (SqlConnection conn = new SqlConnection(connStr))
			{
				string query = "SELECT Price FROM Comps WHERE Id = @id";
				SqlCommand cmd = new SqlCommand(query, conn);
				cmd.Parameters.AddWithValue("@id", compId);

				conn.Open();
				object result = cmd.ExecuteScalar();
				conn.Close();

				return result != null ? Convert.ToDecimal(result) : 0;
			}
		}

		private string UpdatePrice()
		{
			decimal totalPrice = basePrice;

			if (CPUDropDown.SelectedValue != "")
				totalPrice += GetComponentPrice(Convert.ToInt32(CPUDropDown.SelectedValue));
			if (DisplayDropDown.SelectedValue != "")
				totalPrice += GetComponentPrice(Convert.ToInt32(DisplayDropDown.SelectedValue));
			if (HDDropDown.SelectedValue != "")
				totalPrice += GetComponentPrice(Convert.ToInt32(HDDropDown.SelectedValue));
			if (RAMDropDown.SelectedValue != "")
				totalPrice += GetComponentPrice(Convert.ToInt32(RAMDropDown.SelectedValue));
			if (SoundDropDown.SelectedValue != "")
				totalPrice += GetComponentPrice(Convert.ToInt32(SoundDropDown.SelectedValue));

			Price.Text = "Price: $" + totalPrice.ToString("0.00");
			return totalPrice.ToString("0.00");
		}

		protected void Component_Changed(object sender, EventArgs e)
		{
			UpdatePrice();
		}

		protected void Button1_Click(object sender, EventArgs e)
		{
			var config = new
			{
				ComputerId = Request.QueryString["pc"],
				CPU = CPUDropDown.SelectedValue,
				Display = DisplayDropDown.SelectedValue,
				HDD = HDDropDown.SelectedValue,
				RAM = RAMDropDown.SelectedValue,
				Sound = SoundDropDown.SelectedValue,
				Price = UpdatePrice()
			};

			string cookieId = Guid.NewGuid().ToString();
			HttpCookie cartCookie = new HttpCookie("CartItem_" + cookieId);
			cartCookie.Path = "/part4";
			cartCookie.Values["ComputerId"] = config.ComputerId;
			cartCookie.Values["CPU"] = config.CPU;
			cartCookie.Values["Display"] = config.Display;
			cartCookie.Values["HDD"] = config.HDD;
			cartCookie.Values["RAM"] = config.RAM;
			cartCookie.Values["Sound"] = config.Sound;
			cartCookie.Values["Price"] = config.Price;
			cartCookie.Expires = DateTime.Now.AddMonths(1);
			Response.Cookies.Add(cartCookie);

			Response.Redirect("cart.aspx");
		}
	}
}
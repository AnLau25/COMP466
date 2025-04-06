using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace TMA3a.part4
{
	public partial class Orders : System.Web.UI.Page
	{
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

				int userId = Convert.ToInt32(Session["UserId"]);
				
				string htmlOutput = DisplayOrders(userId);
				orderContainer.InnerHtml = htmlOutput;
			}
			else
			{
				Response.Redirect("login.aspx");
			}
		}

		private string DisplayOrders(int userId)
		{
			string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;
			StringBuilder html = new StringBuilder();

			using (SqlConnection connect = new SqlConnection(connStr))
			{
				string query = @"
				SELECT 
					O.Id AS OrderId,
					O.Address, O.CardNo, O.Price,
					PC.Name AS PCName,
					CPU.Name AS CPUName,
					DIS.Name AS DisplayName,
					HD.Name AS HDName,
					RAM.Name AS RAMName,
					SND.Name AS SoundName
				FROM Orders O
				JOIN PCs PC ON O.PC_ID = PC.Id
				JOIN Comps CPU ON O.CPU_ID = CPU.Id
				JOIN Comps DIS ON O.Display_ID = DIS.Id
				JOIN Comps HD ON O.HD_ID = HD.Id
				JOIN Comps RAM ON O.RAM_ID = RAM.Id
				JOIN Comps SND ON O.Sound_ID = SND.Id
				WHERE O.User_ID = @UserId";

				SqlCommand cmd = new SqlCommand(query, connect);
				cmd.Parameters.AddWithValue("@UserId", userId);

				connect.Open();
				SqlDataReader reader = cmd.ExecuteReader();

				if (reader.HasRows)
				{
					while (reader.Read())
					{
						html.Append("<div class='order'>");
						html.AppendFormat("<h3>Order number: {0}</h3>", reader["OrderId"]);
						html.AppendFormat("<p><strong>PC:</strong> {0}</p>", reader["PCName"]);
						html.AppendFormat("<p><strong>Cost:</strong> {0}</p>", reader["Price"]);
						html.AppendFormat("<p><strong>CPU:</strong> {0}</p>", reader["CPUName"]);
						html.AppendFormat("<p><strong>Display:</strong> {0}</p>", reader["DisplayName"]);
						html.AppendFormat("<p><strong>Hard Drive:</strong> {0}</p>", reader["HDName"]);
						html.AppendFormat("<p><strong>RAM:</strong> {0}</p>", reader["RAMName"]);
						html.AppendFormat("<p><strong>Sound Card:</strong> {0}</p>", reader["SoundName"]);
						html.AppendFormat("<p><strong>Shipping Address:</strong> {0}</p>", reader["Address"]);
						html.AppendFormat("<p><strong>Card Number:</strong> **** **** **** {0}</p>", reader["CardNo"].ToString().Substring(reader["CardNo"].ToString().Length - 4));
						html.Append("</div>");
					}
				}
				else
				{
					html.Append("<div class='order'><p>Sorry, nothing to see here yet. You are always welcome to buy one of our PC's! :)</p></div>");
				}
				reader.Close();
				connect.Close();
			}

			return html.ToString(); 
		}
	}
}
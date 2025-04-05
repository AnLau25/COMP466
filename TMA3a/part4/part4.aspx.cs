using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Web;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;

namespace TMA3a.part4
{
	public partial class part4 : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			string htmlOutput = GeneratePCSection();
			pcSectionContainer.InnerHtml = htmlOutput;

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
					<option value=""logout"">Log Out</option>
				</select>";
			}

		}

		private string GeneratePCSection()
		{
			StringBuilder sb = new StringBuilder();

			sb.AppendLine("<section id=\"pcs\">");
			sb.AppendLine("<div class=\"section-container\">");
			sb.AppendLine("<div class=\"top\">");
			sb.AppendLine("<h1 class=\"section-title\"><span>SEE our </span> offers</h1>");
			sb.AppendLine("<p class=\"section-subtitle\">Find what suits your needs, or tailor it to your taste</p>");
			sb.AppendLine("</div>");
			sb.AppendLine("<div class=\"bottom\">");

			string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;
			using (SqlConnection connect = new SqlConnection(connStr))
			{
				string query = "SELECT * FROM PCs ORDER BY Id";
				SqlCommand cmd = new SqlCommand(query, connect);
				connect.Open();
				SqlDataReader reader = cmd.ExecuteReader();

				while (reader.Read())
				{
					int id = (int)reader["Id"];
					string name = reader["Name"].ToString();
					string descript = reader["Descript"].ToString();
					decimal price = (decimal)reader["Price"];

					sb.AppendLine($"<div class=\"exmpl-item\" id=\"{id}\">");
					sb.AppendLine("<div class=\"exmpl-info\">");
					sb.AppendLine($"<h1>{name}</h1>");
					sb.AppendLine($"<p>{descript}</p>");
					sb.AppendLine($"<p><strong>Price with default components: </strong>{price:C}</p>");
					sb.AppendLine($"<a href=\"/part3/pay.aspx?pc={id}\" type=\"button\" class=\"cta\">Buy</a>");
					sb.AppendLine("</div>");
					sb.AppendLine("<div class=\"exmpl-cont\">");
					sb.AppendLine("<img style=\"height:55rem;\" src=\"/shared/laptop.png\" alt=\"img\">");
					sb.AppendLine("</div>");
					sb.AppendLine("</div>");
				}
			}

			sb.AppendLine("</div></div></section>");

			return sb.ToString();
		}
	}
}
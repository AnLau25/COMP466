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
	public partial class comps : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			string htmlOutput = GeneratePCSection();
			litComponents.InnerHtml = htmlOutput;

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
			string connectionString = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;
			Dictionary<string, List<Component>> groupedComponents = new Dictionary<string, List<Component>>();

			using (SqlConnection connect = new SqlConnection(connectionString))
			{
				connect.Open();
				string query = @"
                SELECT 
                    c.Id AS CompId,
                    c.Name AS CompName,
                    c.Type,
                    c.Descript,
                    c.Price,
                    p.Name AS PCName
                FROM Comps c
                LEFT JOIN Compat cmp ON c.Id = cmp.Comp_ID
                LEFT JOIN PCs p ON cmp.PC_ID = p.Id
                ORDER BY c.Type, c.Name";

				SqlCommand cmd = new SqlCommand(query, connect);
				SqlDataReader reader = cmd.ExecuteReader();

				Dictionary<int, Component> components = new Dictionary<int, Component>();

				while (reader.Read())
				{
					int compId = Convert.ToInt32(reader["CompId"]);
					string type = reader["Type"].ToString();

					if (!components.ContainsKey(compId))
					{
						components[compId] = new Component
						{
							Id = compId,
							Name = reader["CompName"].ToString(),
							Type = type,
							Description = reader["Descript"].ToString(),
							Price = Convert.ToDecimal(reader["Price"]),
							CompatiblePCs = new List<string>()
						};
					}

					string pcName = reader["PCName"].ToString();
					if (!string.IsNullOrEmpty(pcName) && !components[compId].CompatiblePCs.Contains(pcName))
					{
						components[compId].CompatiblePCs.Add(pcName);
					}
				}

				foreach (var comp in components.Values)
				{
					if (!groupedComponents.ContainsKey(comp.Type))
					{
						groupedComponents[comp.Type] = new List<Component>();
					}
					groupedComponents[comp.Type].Add(comp);
				}
			}

			return GenerateHtml(groupedComponents);
		}

		private string GenerateHtml(Dictionary<string, List<Component>> groups)
		{
			StringBuilder html = new StringBuilder();

			foreach (var group in groups)
			{
				html.AppendLine("<div class=\"card-section\">");
				html.AppendLine($"    <h1><span>{group.Key}</span></h1>");
				html.AppendLine("    <div class=\"card-row\">");

				foreach (var comp in group.Value)
				{
					html.AppendLine("        <div class=\"card\">");
					html.AppendLine($"            <h2>{comp.Name}</h2>");
					html.AppendLine($"            <p>{comp.Description}</p>");
					html.AppendLine($"            <p><span>Price:</span> {comp.Price}$</p>");
					html.AppendLine($"            <p><span>Compatible with:</span> {string.Join(", ", comp.CompatiblePCs)}</p>");
					html.AppendLine("        </div>");
				}

				html.AppendLine("    </div>");
				html.AppendLine("</div>");
			}

			return html.ToString();
		}

		public class Component
		{
			public int Id { get; set; }
			public string Name { get; set; }
			public string Type { get; set; }
			public string Description { get; set; }
			public decimal Price { get; set; }
			public List<string> CompatiblePCs { get; set; }
		}
	}
}
//Fernando WeFinishJapan
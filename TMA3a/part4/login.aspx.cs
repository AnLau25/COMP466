using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Services;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Security.Cryptography;
using System.Text;

namespace TMA3a.part4
{
	public partial class login : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{

		}

		protected void BtnLogin_Click(object sender, EventArgs e)
		{
			string username = txtUsername.Text.Trim();
			string password = txtPassword.Text.Trim();
			string hashedpw = HashPassword(password);

			string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;
			using (SqlConnection connect = new SqlConnection(connStr))
			{
				string query = "SELECT * FROM Users WHERE Name = @Name AND Password = @Password";
				SqlCommand cmd = new SqlCommand(query, connect);
				cmd.Parameters.AddWithValue("@Name", username);
				cmd.Parameters.AddWithValue("@Password", hashedpw);

				connect.Open();
				SqlDataReader reader = cmd.ExecuteReader();

				if (reader.Read())
				{
					int userId = Convert.ToInt32(reader["Id"]); 
					Session["userID"] = userId;
					Session["username"] = username;
					Response.Redirect("part4.aspx");
				}
				else
				{
					loginMessage.Text = "Invalid username or password. Try again!";
				}
			}
		}

		private static string HashPassword(string password)
		{
			using (SHA256 sha256 = SHA256.Create())
			{
				byte[] bytes = Encoding.UTF8.GetBytes(password);
				byte[] hash = sha256.ComputeHash(bytes);
				StringBuilder builder = new StringBuilder();
				foreach (var b in hash)
				{
					builder.Append(b.ToString("x2"));
				}
				return builder.ToString();
			}
		}

	}
}

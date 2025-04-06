using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Security.Cryptography;
using System.Text;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace TMA3a.part4
{
	public partial class profile : System.Web.UI.Page
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
			}else{
				Response.Redirect("login.aspx");
			}
		}

		protected void Changebtn_Click(object sender, EventArgs e)
		{
			int userId = Convert.ToInt32(Session["userID"]);
			string newName = NameBox.Text.Trim();
			string oldPassword = OldpwrdBox.Text.Trim();
			string newPassword = NewpwrdBox.Text.Trim();

			string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;

			using (SqlConnection connect = new SqlConnection(connStr))
			{
				connect.Open();

				string storedHash = "";
				using (SqlCommand cmd = new SqlCommand("SELECT Password FROM Users WHERE Id = @Id", connect))
				{
					cmd.Parameters.AddWithValue("@Id", userId);
					SqlDataReader reader = cmd.ExecuteReader();
					if (reader.Read())
					{
						storedHash = reader["Password"].ToString();
					}
					reader.Close();
				}

				if (!string.IsNullOrEmpty(newName))
				{
					using (SqlCommand checkCmd = new SqlCommand("SELECT COUNT(*) FROM Users WHERE Name = @Name", connect))
					{
						checkCmd.Parameters.AddWithValue("@Name", newName);
						int count = (int)checkCmd.ExecuteScalar();

						if (count > 0)
						{
							loginMessage.Text = "Name already taken. Please try again!";
						}
						else
						{
							using (SqlCommand cmd = new SqlCommand("UPDATE Users SET Name = @Name WHERE Id = @Id", connect))
							{
								cmd.Parameters.AddWithValue("@Name", newName);
								cmd.Parameters.AddWithValue("@Id", userId);
								cmd.ExecuteNonQuery();
							}
							Session.Clear();
							Session.Abandon();
							Response.Redirect("login.aspx");
						}
					}
				}

				if (!string.IsNullOrEmpty(oldPassword) && !string.IsNullOrEmpty(newPassword))
				{
					string oldPasswordHash = HashPassword(oldPassword);
					if (oldPasswordHash == storedHash)
					{
						string newPasswordHash = HashPassword(newPassword);
						using (SqlCommand cmd = new SqlCommand("UPDATE Users SET Password = @Password WHERE Id = @Id", connect))
						{
							cmd.Parameters.AddWithValue("@Password", newPasswordHash);
							cmd.Parameters.AddWithValue("@Id", userId);
							cmd.ExecuteNonQuery();
						}

						Session.Clear();
						Session.Abandon();
						Response.Redirect("login.aspx");
					}
					else
					{
						loginMessage.Text = " Wrong old password. Please try again!";
					}
				}
				else if (!string.IsNullOrEmpty(oldPassword) || !string.IsNullOrEmpty(newPassword))
				{
					loginMessage.Text = "You need both passwords to proceed. Please try again!";
				}

					connect.Close();
			}
		}

		protected void Delbtn_Click(object sender, EventArgs e)
		{
			int userId = Convert.ToInt32(Session["UserId"]);
			string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;

			using (SqlConnection connect = new SqlConnection(connStr))
			{
				connect.Open();
				using (SqlCommand cmd = new SqlCommand("DELETE FROM Users WHERE Id = @Id", connect))
				{
					cmd.Parameters.AddWithValue("@Id", userId);
					cmd.ExecuteNonQuery();
				}
				connect.Close();
			}

			Session.Clear();
			Session.Abandon();
			Response.Redirect("part4.aspx");
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
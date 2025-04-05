using System;
using System.Configuration;
using System.Data.SqlClient;
using System.Security.Cryptography;
using System.Text;
using System.Web.UI;

namespace TMA3a.part4
{
	public partial class signin : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			
		}

		protected void SignInButton_Click(object sender, EventArgs e)
		{
			string username = UsernameTextBox.Text.Trim();
			string password1 = PasswordTextBox.Text;
			string password2 = ConfirmPasswordTextBox.Text;

			if (string.IsNullOrWhiteSpace(username) ||
				string.IsNullOrWhiteSpace(password1) ||
				string.IsNullOrWhiteSpace(password2))
			{
				loginMessage.Text = "All fields are required. Please try again!";
				return;
			}

			if (password1 != password2)
			{
				loginMessage.Text = "Passwords do not match. Please try again!";
				return;
			}

			string hashedPassword = HashPassword(password1);

			try
			{
				string connStr = ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString;

				using (SqlConnection connect = new SqlConnection(connStr))
				{
					connect.Open();

					using (SqlCommand checkUser = new SqlCommand("SELECT COUNT(*) FROM Users WHERE Name = @Name", connect))
					{
						checkUser.Parameters.AddWithValue("@Name", username);
						int exists = (int)checkUser.ExecuteScalar();
						if (exists > 0)
						{
							loginMessage.Text = "Username already exists. Please try again!";
							return;
						}
					}

					int newId = 1;
					using (SqlCommand getMaxIdCmd = new SqlCommand("SELECT ISNULL(MAX(Id), 0) + 1 FROM Users", connect))
					{
						newId = (int)getMaxIdCmd.ExecuteScalar();
					}

					using (SqlCommand cmd = new SqlCommand("INSERT INTO Users (Id, Name, Password) VALUES (@Id, @Name, @Password)", connect))
					{
						cmd.Parameters.AddWithValue("@Id", newId);
						cmd.Parameters.AddWithValue("@Name", username);
						cmd.Parameters.AddWithValue("@Password", hashedPassword);
						cmd.ExecuteNonQuery();
					}
				}

				Response.Redirect("login.aspx");
			}
			catch (Exception ex)
			{
				loginMessage.Text = ex.Message + "Please try again!";
				return;
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

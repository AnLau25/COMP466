using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;

namespace PhoneBook
{
	public partial class Contact : System.Web.UI.Page
	{
		SqlConnection connect = new SqlConnection(ConfigurationManager.ConnectionStrings[""].ConnectionString);
		SqlCommand cmd;
		SqlDataReader dr;
		protected void Page_Load(object sender, EventArgs e)
		{

		}

		protected void btnAdd_Click(object sender, EventArgs e)
		{
			connect.Open();
			cmd = new SqlCommand("INSERT INTO Numbers VALUES (@lastName, @firstName, @num)", connect);

			cmd.Parameters.AddWithValue("@lastName", txtlastName.Text);
			cmd.Parameters.AddWithValue("@firstName", txtfistName.Text); 
			cmd.Parameters.AddWithValue("@num", txtnum.Text);

			int count = cmd.ExecuteNonQuery();
			connect.Close(); 

			if (count == 1){
				ClientScript.RegisterStartupScript(this.GetType(), "added", "<script>alert('Contact added!');</script>");
			}
		}
		protected void btnFind_Click(object sender, EventArgs e)
		{

		}
	}
}
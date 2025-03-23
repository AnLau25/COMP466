using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data.SqlClient;
using System.Configuration;

namespace PhoneBook
{
	public partial class Contact : System.Web.UI.Page
	{
		SqlConnection connect = new SqlConnection(ConfigurationManager.ConnectionStrings[""].ConnectionString);
		SqlCommand cmd;
		SqlDataReader reader;
		protected void Page_Load(object sender, EventArgs e)
		{

		}

		protected void btnAdd_Click(object sender, EventArgs e)
		{
			connect.Open();

		}
		protected void btnFind_Click(object sender, EventArgs e)
		{

		}
	}
}
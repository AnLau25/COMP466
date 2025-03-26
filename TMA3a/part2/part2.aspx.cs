using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;

namespace TMA3a.part2
{
	public partial class part2 : System.Web.UI.Page
	{
		SqlConnection connect = new SqlConnection(ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString);
		SqlCommand cmd;
		SqlDataReader dr;

		protected void Page_Load(object sender, EventArgs e)
		{
			connect.Open();
			cmd = new SqlCommand("SELECT * FROM Canvas_Imgs FOR JSON AUTO");


		}

		protected void togglePlay(object sender, EventArgs e){
		}

		protected void toggleMode(object sender, EventArgs e){
		}

		protected void showPrev(object sender, EventArgs e){
		}

		protected void showNext(object sender, EventArgs e){
		}
	}
}
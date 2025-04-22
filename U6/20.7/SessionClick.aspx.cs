using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using static System.Collections.Specialized.BitVector32;

namespace MailBook
{
	public partial class SessionClick : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			if (Session["visits"] == null)
			{
				Session["visits"] = "1";
				Session.Timeout = 1140;
			}else
			{
				Session["visits"] = (int.Parse((Session["visits"]).ToString()) + 1).ToString();
			}

			Sess.Text = "You've been here " + (Session["visits"]).ToString() + " times";

			IP.Text = "Your location is " + Request.UserHostAddress.ToString();

			TimeZone.Text = "Your time zone is " + TimeZoneInfo.Local.StandardName.ToString();



		}
			
	}
}
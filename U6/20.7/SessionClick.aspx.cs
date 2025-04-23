using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Configuration;
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

		protected void GetGCD(object sender, EventArgs e)
		{
			int m = int.Parse(M.Text);
			int n = int.Parse(N.Text);

			int gcd = 1;

			for (int i = 1; i <= m && i <= n; i++)
			{
				if (m % i == 0 && n % i == 0) {
					gcd = i;
				}
			}

			if (Request.Cookies["GCD"] != null)
			{
				Request.Cookies["GCD"].Values["number"] = gcd.ToString();
			}
			else
			{
				HttpCookie cookie = new HttpCookie("GCD");
				cookie.Expires = DateTime.Now.AddMinutes(10);
				cookie.Values["number"] = gcd.ToString();
				Response.Cookies.Add(cookie);
			}
				
			OutGCD.Text = "The GCD of " + m.ToString() + " and " + n.ToString() + " is " + Request.Cookies["GCD"].Values["number"].ToString();
		}
			
	}
}
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Diagnostics;
using System.Web.Services.Description;

namespace TMA3a
{
	public partial class part1 : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{	//IP
			string userIp = Request.ServerVariables["HTTP_X_FORWARDED_FOR"];
			if (string.IsNullOrEmpty(userIp))
			{
				userIp = Request.ServerVariables["REMOTE_ADDR"];
			}

			ViewState["UserIP"] = userIp;

			//Cookie! \(>o<)/
			HttpCookie cookie = Request.Cookies["countVisit"];

			if (cookie == null) {
				HttpCookie cookieCounter = new HttpCookie("countVisit");
				cookieCounter.Value = 1.ToString();//First visit
				cookieCounter.Expires = DateTime.Now.AddDays(30);
				Response.Cookies.Add(cookieCounter);
				System.Diagnostics.Debug.WriteLine(cookieCounter.Value);
			}
			else
			{
				int soFar = int.Parse(cookie.Value);
				soFar++;
				cookie.Value = soFar.ToString();
				cookie.Expires = DateTime.Now.AddDays(30);
				Response.Cookies.Set(cookie);
				System.Diagnostics.Debug.WriteLine(cookie.Value);
			}
			

		}
	}
}
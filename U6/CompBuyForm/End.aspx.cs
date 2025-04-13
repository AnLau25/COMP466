using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Configuration;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace CompBuyForm
{
	public partial class End : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			HttpCookie cookie = Request.Cookies["Baught"];
			if (cookie != null)
			{
				string FirstName = cookie.Values["FName"];
				string LastName = cookie.Values["LName"];
				string Address = cookie.Values["Addr"];
				string Email = cookie.Values["Mail"];
				string Laptop = cookie.Values["PC"];
				string Component = cookie.Values["Comp"];
				string Total = cookie.Values["Price"];

				FName.Text = "First Name: " + FirstName;
				LName.Text = "Last Name: " + LastName;
				Addr.Text = "Address: " + Address;
				Mail.Text = "E-Mail: " + Email;
				PC.Text = "PC baught: " + Laptop;
				Comps.Text = "Component baught: " + Component;
				Price.Text = "Price: " + Total;

				string IpAdr = HttpContext.Current.Request.UserHostAddress;
				IP.Text = "Baught from: " + IpAdr;
			}

		}
	}
}
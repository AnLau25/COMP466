using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace CompBuyForm
{
	public partial class WebForm1 : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
		
			Set_Total(sender, e);
			
		}

		protected void Set_Total (object sender, EventArgs e)
		{
			int Pc = int.Parse(PC.SelectedValue);
			int Comp = int.Parse(Comps.SelectedValue);
			int totalPrice = Pc + Comp;
			Total.Text = "Total Price: $" + totalPrice.ToString("F2");
			
		}

		protected void On_Submit (object sender, EventArgs e){

			try {
				string Fname = Name.Text;
				string Lname = LName.Text;
				string Address = Addr.Text;
				string Email = Mail.Text;
				string Pc = PC.SelectedItem.Text;
				string Comp = Comps.SelectedItem.Text;
				int Total = int.Parse(Comps.SelectedValue) + int.Parse(PC.SelectedValue);

				if (Fname == "" || Lname == "" || Address == "" || Email == "" || Pc == "" || Comp == "")
				{
					Err.Text = "All fields must be filled and valid";
				} else {
					HttpCookie cookie = new HttpCookie("Baught");
					cookie.Expires = DateTime.Now.AddMinutes(10);
					cookie.Values["FName"]= Fname;
					cookie.Values["LName"] = Lname;
					cookie.Values["Addr"] = Address;
					cookie.Values["Mail"] = Email;
					cookie.Values["PC"] = Pc;
					cookie.Values["Comp"] = Comp;
					cookie.Values["Price"] = Total.ToString("F2"); 

					Response.Cookies.Add(cookie);

					Response.Redirect("End.aspx");
				}

			}catch (Exception Error){ 
				Err.Text = Error.Message;
			}
				


		}
	}
}
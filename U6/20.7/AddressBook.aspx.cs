using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace MailBook
{
	public partial class AddressBook : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{

		}

		protected void Send(object sender, EventArgs e){
			string name = Name.Text;
			string mail = Email.Text;
			string msg = Msg.Text;

			HttpCookie cookie = new HttpCookie("Message");
			cookie.Expires = DateTime.Now.AddMinutes(10);

			cookie.Values["Name"] = name;
			cookie.Values["Email"] = mail;
			cookie.Values["Message"] = msg;

			showName.Text = "Message sent to: " + name;
			showMail.Text = "Via e-mail: " + mail;
			showMessage.Text = "Message: " + msg;

			Name.Text = "";
			Email.Text = "";
			Msg.Text = "";
		
		
		}
	}
}
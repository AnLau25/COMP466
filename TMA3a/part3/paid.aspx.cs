using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace TMA3a.part3
{
	public partial class paid : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			if (!IsPostBack)
			{
				HttpCookie purchaseCookie = Request.Cookies["PurchaseDetails"];
				if (purchaseCookie != null)
				{
					LabelComputerChoice.Text = "Computer: " + purchaseCookie["ComputerChoice"];
					LabelRAM.Text = "RAM: " + purchaseCookie["RAM"];
					LabelHDD.Text = "HHD: " + purchaseCookie["HDD"];
					LabelCPU.Text = "CPU: " + purchaseCookie["CPU"];
					LabelDisplay.Text = "Display: " + purchaseCookie["Display"];
					LabelSoundCard.Text = "Soundcard: " + purchaseCookie["SoundCard"];
					LabelFirstName.Text = "First Name: " + purchaseCookie["FirstName"];
					LabelLastName.Text = "Last Name: " + purchaseCookie["LastName"];
					LabelAddress.Text = "Address: " + purchaseCookie["Address"];
					LabelEmail.Text = "E-mail: " + purchaseCookie["Email"];
					LabelFinalPrice.Text = purchaseCookie["FinalPrice"];
				}
			}
		}

	}
}

public partial class End:System.Web.UI.Page{
	protected void Page_Load(object sender, EventArgs e){
		HttpCookie cookie = Request.Cookies["Receipt"];
		if(cookie!=null){
			FName.Text = "First Name: " + cookie.Values["FName"];		
			LName.Text = "Last Name: " + cookie.Values["LName"];
			Adr.Text = "Mailing Address: " + cookie.Values["Adr"];
			Phone.Text = "Phone number: " + cookie.Values["Phone"];
			Email.Text = "Email: " + cookie.Values["Email"];
			Pc.Text = "Pc Choice: " + cookie.Values["Pc"];
			Comp.Text = "Component Choice: " + cookie.Values["Comp"];
			Price.Text = "Price: " + cookie.Values["Price"];


			IP.Text = "Baught from: " + HttpContext.Current.Request.UserHostAddress;
		}
	
	}
}
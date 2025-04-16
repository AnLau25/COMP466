

public partial class store:System.Web.UI.Page{

	protected void Page_Load(object sender, EventArgs e){
		Set_Price(sender, e);
	}

	protected void Set_Price (object sender, EventArgs e){
	
		try{
			int Pc_price = int.Parse(Pc.SelectedValue);
			int Comp_price = int.Parse(Comp.SelectedValue);
			int total = Pc_price + Comp_price;
			Price.Text = "Total: " + total.ToString("F2") + "$"; 
		
		}catch(Exeception error){
			Err.Text = error.Message;
		}
	
	}

	protected void Handle_Submit(object sender, EventArgs e){
		string F_Name = FName.Text;
		string L_Name = LName.Text;
		string Address = Adr.Text;
		string Tel = Phone.Text;
		string E_mail = Email.Text;
		string PC = Pc.SelectedItem.Text;
		string Component = Comp.SelectedItem.Text;
		string Payed = (int.Parse(Pc.SelectedValue) + int.Parse(Comp.SelectedValue)).ToString();
			
		if(F_Name==""||L_Name==""|| Tel == "" ||Address==""||E_mail==""||PC==""||Component==""||Payed==""){
			Err.Text = "All fields must be valid";
		}else{
		
		
			try{
				HttpCookie cookie = new HttpCookie("Receipt");
				cookie.Expires = DateTime.Now.AddMinutes(10);
		
				cookie.Values["FName"] = F_Name;
				cookie.Values["LName"] = L_Name;
				cookie.Values["Adr"] = Address;
				cookie.Values["Phone"] = Tel;
				cookie.Values["Email"] = E_mail;
				cookie.Values["Pc"] = PC;
				cookie.Values["Comp"] = Component;
				cookie.Values["Price"] = Payed;
			
				Response.Cookies.Add(cookie);
				Response.Redirect("End.aspx");
			
			}catch(Excption error){
				Err.Text = error.Message;
			}
		}

	}


}
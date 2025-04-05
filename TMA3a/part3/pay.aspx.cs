using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace TMA3a.part3
{
	public partial class pay : System.Web.UI.Page
	{
		protected void Page_Load(object sender, EventArgs e)
		{
			if (!IsPostBack)
			{
				string pcVal = Request.QueryString["pc"];

				int pc;
				if (int.TryParse(pcVal, out pc))
				{
					LoadDropDowns(pc);
					AssignPchoice(pc);
					SetInitialPrice(pc);
				}

			}
		}

		private void AssignPchoice(int pc)
		{
			string choiceText;

			switch (pc)
			{
				case 1:
					choiceText = "Dell Inspiron 15";
					break;
				case 2:
					choiceText = "Apple MacBook Air (M2)";
					break;
				case 3:
					choiceText = "Lenovo ThinkPad X1 Carbon Gen 11";
					break;
				case 4:
					choiceText = "HP Pavilion 14";
					break;
				case 5:
					choiceText = "ASUS ROG Strix G17";
					break;
				default:
					choiceText = "Unknown";
					break;
			}

			Pchoice.Text = choiceText; 
		}

		private void SetInitialPrice(int pc)
{
			Dictionary<int, double> basePrices = new Dictionary<int, double>()
			{
				{ 1, 449.99 }, { 2, 799.00 }, { 3, 1215.00 }, { 4, 1099.99 }, { 5, 1899.00 }
			};

			if (basePrices.ContainsKey(pc))
			{
				Price.Text = "Total Price: $" + basePrices[pc];
			}
		}

		private void LoadDropDowns(int pc)
		{
			Dictionary<int, List<(string display, string value)>> ramOptions = new Dictionary<int, List<(string display, string value)>>(){
				{ 1, new List<(string, string)> { ("8GB RAM", "40")} },
				{ 2, new List<(string, string)> { ("32GB LPDDR5", "250"), ("16GB LPDDR5", "130") } },
				{ 3, new List<(string, string)> { ("32GB LPDDR5", "250"), ("16GB RAM", "50"), ("32GB DDR4", "120"), ("16GB LPDDR5", "130") } },
				{ 4, new List<(string, string)> { ("8GB RAM", "40") } },
				{ 5, new List<(string, string)> { ("16GB RAM", "50"), ("32GB DDR4", "120") } }
			};

			Dictionary<int, List<(string display, string value)>> hddOptions = new Dictionary<int, List<(string display, string value)>>(){
				{ 1, new List<(string, string)> { ("256GB SSD", "30"), ("2TB HDD", "55") } },
				{ 2, new List<(string, string)> {  ("512GB SSD", "75") } },
				{ 3, new List<(string, string)> { ("1TB PCIe SSD", "70"), ("512GB SSD", "75"),  ("4TB PCIe SSD", "240") } },
				{ 4, new List<(string, string)> { ("256GB SSD", "30"), ("1TB PCIe SSD", "70"), ("2TB HDD", "55") } },
				{ 5, new List<(string, string)> { ("4TB PCIe SSD", "240"), ("1TB PCIe SSD", "70") } }
			};

			Dictionary<int, List<(string display, string value)>> cpuOptions = new Dictionary<int, List<(string display, string value)>>(){
				{ 1, new List<(string, string)> { ("Intel Core i5-1235U", "250"), ("AMD Ryzen 5 5625U", "200") } },
				{ 2, new List<(string, string)> { ("Apple M2 Chip", "250"), ("Intel Core i7-1360P", "400")} },
				{ 3, new List<(string, string)> {  ("Intel Core i7-1360P", "400"), ("AMD Ryzen 9 7945HX", "700") } },
				{ 4, new List<(string, string)> { ("AMD Ryzen 5 5625U", "200"), ("Intel Core i5-1235U", "250")} },
				{ 5, new List<(string, string)> { ("AMD Ryzen 9 7945HX", "700") } }
			};

			Dictionary<int, List<(string display, string value)>> displayOptions = new Dictionary<int, List<(string display, string value)>>(){
				{ 1, new List<(string, string)> { ("15.6\" FHD (1920x1080) Anti-Glare LED-backlit", "100") } },
				{ 2, new List<(string, string)> {  ("13.6\" Liquid Retina Display (2560x1664)", "300") } },
				{ 3, new List<(string, string)> {  ("14\" WUXGA (1920x1200) IPS with Anti-Glare", "150"), ("14\" UHD (3840x2160) OLED", "450") } },
				{ 4, new List<(string, string)> { ("15.6\" FHD (1920x1080) Anti-Glare LED-backlit", "100") } },
				{ 5, new List<(string, string)> { ("17.3\" QHD (2560x1440), 165Hz Refresh Rate", "350") } }
			};

			Dictionary<int, List<(string display, string value)>> soundOptions = new Dictionary<int, List<(string display, string value)>>(){
				{ 1, new List<(string, string)> { ("Realtek HD Audio", "15") } },
				{ 2, new List<(string, string)> { ("Integrated High-Fidelity Audio", "50"), ("Dolby Atmos Speaker System", "50") } },
				{ 3, new List<(string, string)> { ("Dolby Atmos Speaker System", "50"), ("Integrated High-Fidelity Audio", "50") } },
				{ 4, new List<(string, string)> { ("Realtek HD Audio", "15") } },
				{ 5, new List<(string, string)> { ("ESS Sabre Hi-Fi DAC", "100"), ("Creative Sound Blaster", "75") } }
			};

			PopulateDropdown(DropDownList1, ramOptions, pc);
			PopulateDropdown(DropDownList2, hddOptions, pc);
			PopulateDropdown(DropDownList3, cpuOptions, pc);
			PopulateDropdown(DropDownList4, displayOptions, pc);
			PopulateDropdown(DropDownList5, soundOptions, pc);
		}

		private void PopulateDropdown(DropDownList dropdown, Dictionary<int, List<(string display, string value)>> options, int pc)
		{
			dropdown.Items.Clear();
			if (options.ContainsKey(pc))
			{
				foreach (var (display, value) in options[pc])
				{
					dropdown.Items.Add(new ListItem(display, value));
				}
			}
		}

		protected void Button1_Click(object sender, EventArgs e)
		{
			
			string computerChoice = Pchoice.Text;
			string ram = DropDownList1.SelectedItem.Text;
			string hdd = DropDownList2.SelectedItem.Text;
			string cpu = DropDownList3.SelectedItem.Text;
			string display = DropDownList4.SelectedItem.Text;
			string soundCard = DropDownList5.SelectedItem.Text;
			string firstName = TextBox1.Text;
			string lastName = TextBox2.Text;
			string address = TextBox3.Text;
			string email = TextBox4.Text;
			string finalPrice = Price.Text; // Contains "Total Price: $..."

			
			HttpCookie purchaseCookie = new HttpCookie("PurchaseDetails");
			purchaseCookie["ComputerChoice"] = computerChoice;
			purchaseCookie["RAM"] = ram;
			purchaseCookie["HDD"] = hdd;
			purchaseCookie["CPU"] = cpu;
			purchaseCookie["Display"] = display;
			purchaseCookie["SoundCard"] = soundCard;
			purchaseCookie["FirstName"] = firstName;
			purchaseCookie["LastName"] = lastName;
			purchaseCookie["Address"] = address;
			purchaseCookie["Email"] = email;
			purchaseCookie["FinalPrice"] = finalPrice;

			
			purchaseCookie.Expires = DateTime.Now.AddHours(1);

			
			Response.Cookies.Add(purchaseCookie);

			
			Response.Redirect("/part3/paid.aspx");
		}
	}
}
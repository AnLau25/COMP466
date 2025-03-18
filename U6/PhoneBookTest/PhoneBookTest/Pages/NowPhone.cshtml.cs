using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;

namespace PhoneBookTest.Pages
{
    public class NowPhoneModel : PageModel
    {
		public bool hasData = false;
		public string fistName = "";
		public string lastName = "";
		public string phoneNum = "";

		public void OnGet()
        {
        }
        public void OnPost()
        {
            hasData = true;
            fistName = Request.Form["firstname"];
		    lastName = Request.Form["lastname"];
		    phoneNum = Request.Form["phonenum"];
        }
    }
}

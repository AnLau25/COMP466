using Microsoft.AspNetCore.Mvc;

namespace Phonetest2.Controllers
{
	public class ContactController : Controller
	{
		public IActionResult Index()
		{
			return View();
		}
	}
}

using System.ComponentModel.DataAnnotations;

namespace Phonetest2.Models
{
	public class ContactDto
	{
		[Required(ErrorMessage = "Nombre necesario")]
		public string Firstname { get; set; } = "";
		[Required(ErrorMessage = "Apellido necesario")]
		public string Lastname { get; set; } = "";
		[Required(ErrorMessage = "Numero necesario")]
		public string Ponenum { get; set; } = "";

	}
}

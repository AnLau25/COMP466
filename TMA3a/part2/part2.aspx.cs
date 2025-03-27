using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;
using System.Web.Services;
using System.Web.Script.Serialization;

namespace TMA3a.part2
{
	public partial class part2 : System.Web.UI.Page
	{
		SqlConnection connect = new SqlConnection(ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString);
		SqlCommand cmd;
		SqlDataReader dr;

		protected void Page_Load(object sender, EventArgs e)
		{

			if (Request.QueryString["getImages"] == "true")
			{
				Response.ContentType = "application/json";
				Response.Write(GetImageData());
				Response.End();
			}

		}
		/*
		public static string FetchImgs()
		{
			part2 instance = new part2();
			return instance.GetImageData();
		}*/

		private string GetImageData(){

			string imagesJson = "[]";

			try
			{
				connect.Open();
				cmd = new SqlCommand("SELECT Img, Caption FROM Canvas_Imgs", connect);
				dr = cmd.ExecuteReader();
				List<object> images = new List<object>();
				while (dr.Read()) {
					images.Add(new
					{
						ImgURL = dr["Img"],
						ImgCaption = dr["Caption"]
					});
				}
				connect.Close();
				JavaScriptSerializer js = new JavaScriptSerializer();
				imagesJson = js.Serialize(images);
			}
			catch (Exception ex) {
				imagesJson = "{\"error\":\"" + ex.Message + "\"}";
			}
			return imagesJson;
		}

	}
}
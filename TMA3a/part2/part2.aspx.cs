using System;
using System.Collections.Generic;
using System.Configuration;
using System.Web.UI;
using System.Data.SqlClient;

namespace TMA3a.part2
{
	public partial class part2 : System.Web.UI.Page
	{
		SqlConnection connect = new SqlConnection(ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString);
		private static readonly Random rand = new Random();

		[Serializable]
		public class Slide
		{
			public string Img { get; set; }
			public string Caption { get; set; }
		}

		private bool IsPlaying
		{
			get => ViewState["IsPlaying"] != null && (bool)ViewState["IsPlaying"];
			set => ViewState["IsPlaying"] = value;
		}

		private bool IsSequential
		{
			get => ViewState["IsSequential"] != null && (bool)ViewState["IsSequential"];
			set => ViewState["IsSequential"] = value;
		}

		private int CurrentIndex
		{
			get => (int)(ViewState["CurrentIndex"] ?? 0);
			set => ViewState["CurrentIndex"] = value;
		}

		private List<Slide> Slides
		{
			get => ViewState["Slides"] as List<Slide>;
			set => ViewState["Slides"] = value;
		}

		protected void Page_Load(object sender, EventArgs e)
		{
			if (!IsPostBack){
				Slides = GetImgs();
				CurrentIndex = 0;
				IsPlaying = false;
				IsSequential = false;
				SlideTimer.Enabled = false;
				DisplaySlide(0);
			}
		}

		private List<Slide> GetImgs()
		{
			List<Slide> slides = new List<Slide>();
			try{
				connect.Open();
				using (SqlCommand cmd = new SqlCommand("SELECT Img, Caption FROM Canvas_Imgs", connect))
				using (SqlDataReader dr = cmd.ExecuteReader()){
					while (dr.Read()){
						slides.Add(new Slide
						{
							Img = dr["Img"].ToString(),
							Caption = dr["Caption"].ToString()
						});
					}
				}
			}catch (Exception ex){
				slides.Add(new Slide { Img = "", Caption = "Error: " + ex.Message });
			
			}finally{
				connect.Close();
			}
			return slides;
		}

		private void DisplaySlide(int index)
		{
			if (Slides != null && Slides.Count > 0){
				Slide slide = Slides[index];
				ImageSlider.ImageUrl = slide.Img;
				Caption.Text = slide.Caption;
			}
		}

		protected void Clock(object sender, EventArgs e)
		{
			if (Slides == null || Slides.Count == 0)
				return;

			if (IsSequential)
			{
				CurrentIndex = rand.Next(Slides.Count);
			}
			else
			{
				CurrentIndex = (CurrentIndex + 1) % Slides.Count;
			}

			ViewState["CurrentIndex"] = CurrentIndex;
			DisplaySlide(CurrentIndex);
		}

		protected void Play_Click(object sender, EventArgs e)
		{
			if (!IsPlaying){
				Play.Text = "Pause";
				SlideTimer.Enabled = true;
			}
			else{
				Play.Text = "Play";
				SlideTimer.Enabled = false;
			}
			IsPlaying = !IsPlaying;
			Clock(sender, e);
		}

		protected void Mode_Click(object sender, EventArgs e)
		{
			IsSequential = !IsSequential;

			if (IsSequential){
				Mode.Text = "SEQUENTIAL";
				Prev.Enabled = false;
				Next.Enabled = false;
				Prev.CssClass = "cta-disabled";
				Next.CssClass = "cta-disabled";
			}else{
				Mode.Text = "RANDOM";
				Prev.Enabled = true;
				Next.Enabled = true;
				Prev.CssClass = "cta";
				Next.CssClass = "cta";
			}
		}

		protected void Prev_Click(object sender, EventArgs e)
		{
			if (Slides != null && Slides.Count > 0){
				CurrentIndex = (CurrentIndex - 1 + Slides.Count) % Slides.Count;
				DisplaySlide(CurrentIndex);
			}
		}

		protected void Next_Click(object sender, EventArgs e)
		{
			if (Slides != null && Slides.Count > 0){
				CurrentIndex = (CurrentIndex + 1) % Slides.Count;
				DisplaySlide(CurrentIndex);
			}
		}
	}
}

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

namespace TMA3a.part2
{
	public partial class part2 : System.Web.UI.Page
	{
		SqlConnection connect = new SqlConnection(ConfigurationManager.ConnectionStrings["ConnectionString"].ConnectionString);
		SqlCommand cmd;
		SqlDataReader dr;
		string qres = "";

		protected void Page_Load(object sender, EventArgs e)
		{
			if (!IsPostBack)
			{
				connect.Open();
				cmd = new SqlCommand("SELECT * FROM Canvas_Imgs FOR JSON AUTO", connect);
				dr = cmd.ExecuteReader();
				if (dr.Read())
				{
					qres = dr.GetString(0);
				}
				connect.Close();

				// Inject JavaScript on page load
				string js = $@"
                    var imgData = {qres};
                    var index = 0;
                    var isPlaying = false;
                    var isSequential = false;
                    var slider, context, playBtn, modeBtn, prevBtn, nextBtn;
            
                    window.onload = function () {{
                        slider = document.getElementById('slider');
                        context = slider.getContext('2d');
                        playBtn = document.getElementById('{play.ClientID}');
                        modeBtn = document.getElementById('{mode.ClientID}');
                        prevBtn = document.getElementById('{prev.ClientID}');
                        nextBtn = document.getElementById('{next.ClientID}');

                        updateCanvas();
                    }};

                    function updateCanvas() {{
                        if (!slider || !slider.getContext) return;
                        let images = Object.values(imgData);
                        let pic = new Image();
                        pic.onload = function () {{
                            slider.width = pic.width;
                            slider.height = pic.height;
                            context.drawImage(pic, 0, 0, slider.width, slider.height);
                        }};
                        pic.src = images[index].img;
                        document.getElementById('caption').textContent = images[index].caption;
                    }}

                    function showPrev() {{
                        index--;
                        if (index < 0) index = Object.values(imgData).length - 1;
                        updateCanvas();
                    }}

                    function showNext() {{
                        index++;
                        if (index >= Object.values(imgData).length) index = 0;
                        updateCanvas();
                    }}

                    function togglePlay() {{
                        isPlaying = !isPlaying;
                        if (isPlaying) {{
                            playBtn.value = 'Pause';
                        }} else {{
                            playBtn.value = 'Play';
                        }}
                    }}

                    function toggleMode() {{
                        isSequential = !isSequential;
                        modeBtn.value = isSequential ? 'RANDOM' : 'SEQUENTIAL';
                    }}
                ";

				ClientScript.RegisterStartupScript(this.GetType(), "initScript", js, true);
			}
		}


		protected void showPrev(object sender, EventArgs e)	{
			ClientScript.RegisterStartupScript(this.GetType(), "showPrev", "showPrev();", true);
		}

		protected void showNext(object sender, EventArgs e)	{
			ClientScript.RegisterStartupScript(this.GetType(), "showNext", "showNext();", true);
		}

		protected void togglePlay(object sender, EventArgs e) {
			ClientScript.RegisterStartupScript(this.GetType(), "togglePlay", "togglePlay();", true);
		}

		protected void toggleMode(object sender, EventArgs e) {
			ClientScript.RegisterStartupScript(this.GetType(), "toggleMode", "toggleMode();", true);
		}

	}
}
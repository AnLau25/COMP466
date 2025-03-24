<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="part1.aspx.cs" Inherits="TMA3a.part1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>COOKIE</title>
    <script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.0/es5/tex-mml-chtml.js">
        </script>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
</head>

<body>
    <!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="#hero">
                        <h1><span>The</span> COOKIE <span>page</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="#q3" data-after="home">&lt; Go back</a></li>
                        <li><a href="/tma3a.htm" data-after="next">See next solution &gt;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->

    <!-- Hero Section  -->
    <section id="hero">
        <div class="hero container">
            <div class="text-block">
                <h1>Hi there, you've been here <span><%= Request.Cookies["countVisit"].Value %> times</span><strong
                        style="font-size: 15px;"> this month</strong></h1>
                <p><strong>IP: </strong><%= ViewState["UserIP"] %></p>
                <!--Look back at IP once on server, same for cookie first call-->
                <p><strong>Time zone: </strong><span style="color:black;" id="timezone">Detecting...</span></p>
            </div>
        </div>
    </section>
    <!-- End Hero Section  -->
     <script>
            document.addEventListener('DOMContentLoaded', function() {
                var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                document.getElementById('timezone').innerText = timeZone;
            });
     </script>"
</body>
</html>

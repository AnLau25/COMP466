<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="part2.aspx.cs" Inherits="TMA3a.part2.part2" %>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
    <script src="canvas.js"></script>
    <title>Canva Slideshow</title>
</head>

<body>
    <section id="canvas">
        <div class="section-container">
            <h1>Here is my canvas App</h1>
            <canvas class="slider" id="slider">
                Imgs here
            </canvas>
            <p class="section-subtitle" id="caption">Image caption here</p>
            <form class="slider-buttons" runat="server">
                <button type="button" id="play" class="cta">Start</button>
                <button type="button" id="mode" class="cta">Random</button>
                <button type="button" id="prev" class="cta">&lt;</button>
                <button type="button" id="next" class="cta">&gt;</button>
            </form>
            <div class='main-nav'>
                <!--Fix nav later-->
                <a href="/tma3a.htm" type="button" class="cta">&lt; Go back to cover page</a>
                <a href="/tma3a.htm" type="button" class="cta">See next solution &gt;</a>
            </div>
            <p class="section-subtitle"> All image rights reserved to photographer extraordinaire: <a
                    href="https://www.instagram.com/parker.project?igsh=ZHVpZ3U1OWI2OWRw&utm_source=qr" target="_blank"
                    class="abi"> Abi Millaire (@parker.project)</a> °˖✧◝(⁰▿⁰)◜✧˖°</p>
        </div>

    </section>
</body>

</html>



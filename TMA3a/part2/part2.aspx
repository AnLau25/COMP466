﻿<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="part2.aspx.cs" Inherits="TMA3a.part2.part2" %>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
    <title>Canva Slideshow</title>
</head>
<body>
    <form id="form6" runat="server">
        <section id="canvas">
            <div class="section-container">
                <h1>Here is my canvas App</h1>
                <asp:ScriptManager ID="ScriptManager" runat="server" />
                <asp:UpdatePanel ID="UpdatePanel" runat="server" UpdateMode="Conditional" ChildrenAsTriggers="true">
                    <ContentTemplate>
                        <asp:Image ID="ImageSlider" CssClass="slider" runat="server" />
                        <p class="section-subtitle">
                            <asp:Label ID="Caption" runat="server" Text="Image caption here" />
                        </p>
                        <asp:Timer ID="SlideTimer" runat="server" Interval="4000" OnTick="Timer_Tick" />
                        <div class="slider-buttons">
                            <asp:Button ID="Play" runat="server" CssClass="cta" Text="Start" OnClick="Play_Click" />
                            <asp:Button ID="Mode" runat="server" CssClass="cta" Text="Random" OnClick="Mode_Click" />
                            <asp:Button ID="Prev" runat="server" CssClass="cta" Text="&lt;" OnClick="Prev_Click" />
                            <asp:Button ID="Next" runat="server" CssClass="cta" Text="&gt;" OnClick="Next_Click" />
                        </div>
                    </ContentTemplate>
                </asp:UpdatePanel>

                <div class='main-nav'>
                    <a href="/tma3a.htm" type="button" class="cta">&lt; Go back to cover page</a>
                </div>

                <p class="section-subtitle">
                    All image rights reserved to photographer extraordinaire:
                    <a href="https://www.instagram.com/parker.project?igsh=ZHVpZ3U1OWI2OWRw&utm_source=qr"
                       target="_blank" class="abi">
                        Abi Millaire (@parker.project)
                    </a> °˖✧◝(⁰▿⁰)◜✧˖°
                </p>
            </div>
        </section>
    </form>
</body>
</html>

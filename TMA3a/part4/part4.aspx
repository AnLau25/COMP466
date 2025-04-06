<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="part4.aspx.cs" Inherits="TMA3a.part4.part4" %>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>README</title>
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
                    <a href="/part4/part4.aspx">
                        <h1><span>The</span> PC <span style="font-size:small;">store</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="/part4/part4.aspx/#pcs" data-after="PCs">Browse computers</a></li>
                        <li><a href="/part4/comps.aspx" data-after="components">Browse components</a></li>
                        <li><a href="#footer" data-after="foot">Contact us</a></li>
                        <li id="userDropdown" runat="server">
                            <a href="/part4/login.aspx" data-after="log">SignIn/LogIn</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->
    <!-- Hero Section  -->
    <section id="hero">
        <div class="hero container" style="flex-direction:column;">       
                <h1>Evryone's <span>favourites </span></h1>    
                <div class="faves">
                    <div class="exmpl-item">
                        <div class="exmpl-cont">
                            <img src="/shared/laptop.png" alt="img">
                        </div>
                        <div class="exmpl-info">
                            <h1 style="color:white !important;">Dell Inspiron 15</h1>
                            <p style="color:white !important;">
                                So, you’re the type to buy a car just to get from point A to point B — the type who sees a computer as the mean to an end. If that’s you, we have exactly what you need.
                            </p>
                             <a href="#1" type="button" class="cta">See more</a>
                        </div>
                    </div>
                    <div class="exmpl-item">
                        <div class="exmpl-cont">
                            <img src="/shared/laptop.png" alt="img">
                        </div>
                        <div class="exmpl-info">
                            <h1 style="color:white !important;">HP Pavilion 14</h1>
                            <p style="color:white !important;">
                                It’s okay, we get it — creativity waits for no one. That’s why you should be ready for action when the spark ignites with the HP Pavilion: compact, casual, and always ready for your next strike of genius.
                            </p>
                             <a href="#4" type="button" class="cta">See more</a>
                        </div>
                    </div>
                </div>
        </div>       
    </section>
    <!-- End Hero Section  -->

    <!-- Computer section -->
        <div id="pcSectionContainer" runat="server"></div>
    <!-- End Computer section -->

    <!-- Footer  -->
    <section id="footer">
        <div class="footer container">
            <div>
                <div class="brand">
                    <h1><span>The</span> PC <span style="font-size:small;">store</span></h1>
                </div>
                <p>Copyright © 2022 Lupin. All rights reserved</p>
            </div>
            
            <div>
                <h2>Where technology meets art</h2>
                <div class="social-icon">
                    <div class="social-item">
                        <a href="/tma3a.htm"><img src="https://img.icons8.com/?size=100&id=91234&format=png&color=000000" /></a>
                    </div>
                    <div class="social-item">
                        <a href="https://github.com/AnLau25" target="_blank"><img src="https://img.icons8.com/?size=100&id=TEYr8ETaIfBJ&format=png&color=000000" /></a>
                    </div>
                    <div class="social-item">
                        <a href="https://github.com/AnLau25/COMP466https://github.com/AnLau25" target="_blank"><img src="https://img.icons8.com/?size=100&id=eeQY_dRSUIMV&format=png&color=000000" /></a>
                    </div>
                    <div class="social-item">
                        <a href="https://github.com/AnLau25/COMP466/tree/master/TMA3a" target="_blank"><img src="https://img.icons8.com/?size=100&id=-x2V8Q63DerT&format=png&color=000000" /></a>
                    </div>
                </div>
            </div>
            <div>
                <p><strong>Questions?</strong></p>
                <p>Contact us at : costumerhelp@thepcstore.com</p>
                <p><strong>Having issues?</strong></p>
                <p>Contact us at : techsupport@thepcstore.com</p>
            </div>
            
        </div>
    </section>
    <!-- Footer  -->
    <script>
       
        function handleUserAction(select) {
            const value = select.value;
            if (value === "profile") {
                window.location.href = 'profile.aspx';
            } else if (value === "cart") {
                window.location.href = 'cart.aspx';
            } else if (value === "orders") {
                window.location.href = 'Orders.aspx';
            } else if (value === "logout") {
                window.location.href = 'part4.aspx?logout=true';
            }
        }
 
    </script>
</body>

</html>
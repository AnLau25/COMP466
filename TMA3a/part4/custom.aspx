<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="custom.aspx.cs" Inherits="TMA3a.part4.custom" %>

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

    <section id="custom">
        <div class="section-container">
            <div class="top">
                <h1 class="section-title"><span>Costumize</span> your choice</h1>
                <p class="section-subtitle">Carefull, different components might make your price vary.</p>
            </div>
            <div>
                <form id="form1" runat="server">
                    <div class="select-comps">
                        <asp:Label ID="Computer" runat="server" CssClass="section-title">-</asp:Label>
                        <asp:Label ID="CPUChoice" runat="server" Text="CPUs" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="CPUDropDown" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="DisplayChoice" runat="server" Text="Displays" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="DisplayDropDown" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="HDChoice" runat="server" Text="Hard Drives" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="HDDropDown" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="RAMChoice" runat="server" Text="RAM" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="RAMDropDown" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="SoundChoice" runat="server" Text="Sound Cards" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="SoundDropDown" runat="server" CssClass="cta"></asp:DropDownList>
                        <div style="margin-top:10px;">
                            <asp:Label ID="Price" runat="server" CssClass="select-label">-</asp:Label>
                            <asp:Button ID="Button1" runat="server" Text="Add to cart" CssClass="cta" OnClick="Button1_Click"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

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

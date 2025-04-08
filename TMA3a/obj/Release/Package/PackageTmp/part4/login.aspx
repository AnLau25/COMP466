<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="login.aspx.cs" Inherits="TMA3a.part4.login" %>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCstore</title>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="theyWouldntLetMeInlineStyle">

    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="part4.aspx">
                        <h1><span>The</span> PC <span style="font-size:small;">store</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="part4.aspx" data-after="main">&lt; Back to main page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="log-in">
        <form id="form1" runat="server">
            <div class="hero container">
                <div class="login-container">
                    <p>Help us identify you, so we can get your orders!</p>

                    <asp:Label ID="lblUsername" runat="server" AssociatedControlID="txtUsername" CssClass="input-label" Text="Username:"></asp:Label>
                    <asp:TextBox ID="txtUsername" runat="server" CssClass="cta" Placeholder="Type in your username" MaxLength="30" TextMode="SingleLine" />

                    <asp:Label ID="lblPassword" runat="server" AssociatedControlID="txtPassword" CssClass="input-label" Text="Password:"></asp:Label>
                    <asp:TextBox ID="txtPassword" runat="server" CssClass="cta" Placeholder="Type in your password" MaxLength="50" TextMode="Password" />

                    <p class="section-subtitle">
                        New around here? No worries, sign up <a href="signin.aspx" class="abi">HERE</a>!
                    </p>

                    <asp:Button ID="btnLogin" runat="server" Text="LOGIN" CssClass="cta" OnClick="BtnLogin_Click" />

                    <asp:Label ID="loginMessage" runat="server" CssClass="subtitle" ForeColor="Red" />
                </div>
            </div>
        </form>
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
</body>
</html>

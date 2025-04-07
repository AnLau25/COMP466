<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="signin.aspx.cs" Inherits="TMA3a.part4.signin" %>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Store</title>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="theyWouldntLetMeInlineStyle">
    <!-- Header -->
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
    <!-- End Header -->

    <section id="log-in">
        <form id="form1" runat="server">
            <div class="hero container">
                <div class="login-container">
                    <p>Let's get you set up so you can start booking!</p>

                    <asp:Label runat="server" Text="Username:" CssClass="input-label" AssociatedControlID="UsernameTextBox" />
                    <asp:TextBox runat="server" ID="UsernameTextBox" CssClass="cta" placeholder="Type in your username" size="30" />

                    <asp:Label runat="server" Text="Password:" CssClass="input-label" AssociatedControlID="PasswordTextBox" />
                    <asp:TextBox runat="server" ID="PasswordTextBox" CssClass="cta" TextMode="Password" placeholder="Type in your password" size="30"/>

                    <asp:Label runat="server" Text="Password verification:" CssClass="input-label" AssociatedControlID="ConfirmPasswordTextBox" />
                    <asp:TextBox runat="server" ID="ConfirmPasswordTextBox" CssClass="cta" TextMode="Password" placeholder="Retype your password" size="30" />

                    <p class="section-subtitle">Already got an account? <a href="login.aspx" class="abi">LOG IN</a>!</p>

                    <asp:Button runat="server" ID="SignInButton" CssClass="cta" Text="SIGNIN" OnClick="SignInButton_Click" />

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

<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="profile.aspx.cs" Inherits="TMA3a.part4.profile" %>

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
                        <li><a href="/part4/part4.aspx#pcs" data-after="PCs">Browse computers</a></li>
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
    <section id="profile">
        <div class="section-container">
            <div class="top">
                <h1 class="section-title"><span>Costumize</span> your account</h1>
                <p class="section-subtitle">If you just want to chnage your name, input it alone. To chnage passwords you need both the old and the new one.You can always change bothe name and password. You can always also, delete your account.</p>
            </div>
            <div class="pay" style="display:block;">
                <form id="form1" runat="server">
                    <div class="profile"  style="align-items:center !important">
                        <asp:Label ID="NName" runat="server" Text="New user name:" CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="NameBox" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Label ID="Oldpwrd" runat="server" Text="Old password:" CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="OldpwrdBox" runat="server" CssClass="cta"></asp:TextBox>                  
                        <asp:Label ID="Newpwrd" runat="server" Text="New password: " CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="NewpwrdBox" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Button ID="Changebtn" runat="server" Text=" Save changes " CssClass="cta" OnClick="Changebtn_Click"/>
                        <asp:Button ID="Delbtn" runat="server" Text="Delete account" CssClass="cta" OnClick="Delbtn_Click"/>
                        <asp:Label ID="loginMessage" runat="server" CssClass="subtitle" ForeColor="Red" />
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

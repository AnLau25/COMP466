﻿<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="cart.aspx.cs" Inherits="TMA3a.part4.cart" %>

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

    <section id="cart">
         <div class="section-container">
            <div class="top">
                <h1 class="section-title">Last step to acquire<span> your PC</span></h1>
                <p class="section-subtitle">Please fill out all the fields carefully.</p>
            </div>                
                <form id="form3" runat="server"> 
                     <div class="thatdiv">
                         <asp:Label ID="LblNoItems" runat="server" Text="There are no items in your cart." CssClass="select-label" Visible="false" />
                         <asp:Repeater ID="CartRepeater" runat="server" OnItemCommand="CartRepeater_ItemCommand">
                            <ItemTemplate>
                                <div class='orders'>
                                    <h3>Order #<%# Container.ItemIndex + 1 %></h3>
                                    <p><strong>PC:</strong> <%# Eval("PCName") %></p>
                                    <p><strong>CPU:</strong> <%# Eval("CPU") %></p>  
                                    <p><strong>Display:</strong> <%# Eval("Display") %></p>
                                    <p><strong>Hard Drive:</strong> <%# Eval("HD") %></p>
                                    <p><strong>RAM:</strong> <%# Eval("RAM") %></p>
                                    <p><strong>Sound:</strong> <%# Eval("Sound") %></p>
                                    <p><strong>Price:</strong> <%# Eval("Price") %></p>
                                    <asp:Button ID="DeleteButton" runat="server" Text="Delete"
                                        CommandName="Delete" CommandArgument='<%# Eval("CookieName") %>' CssClass="cta" />
                                    <asp:Button ID="EditButton" runat="server" Text="Edit"
                                        CommandName="Edit" CommandArgument='<%# Eval("CookieName") %>' CssClass="cta" />
                                </div>
                            </ItemTemplate>
                        </asp:Repeater>
                        <div class="payement">
                            <asp:Label ID="TotalPrice" runat="server" CssClass="select-label">-</asp:Label>
                            <asp:Label ID="FName" runat="server" Text="First Name:" CssClass="select-label"></asp:Label>
                            <asp:TextBox ID="FNameBox" runat="server" CssClass="cta"></asp:TextBox>
                            <asp:Label ID="LName" runat="server" Text="Last Name:" CssClass="select-label"></asp:Label>
                            <asp:TextBox ID="LNameBox" runat="server" CssClass="cta"></asp:TextBox>                  
                            <asp:Label ID="Address" runat="server" Text="Address: " CssClass="select-label"></asp:Label>
                            <asp:TextBox ID="AddressBox" runat="server" CssClass="cta"></asp:TextBox>
                            <asp:Label ID="Email" runat="server" Text="E-mail: " CssClass="select-label"></asp:Label>
                            <asp:TextBox ID="EmailtBox" runat="server" CssClass="cta"></asp:TextBox>
                            <asp:Label ID="CreditCard" runat="server" Text="Credit Card Number: " CssClass="select-label"></asp:Label>
                            <asp:TextBox ID="CreditCardBox" runat="server" CssClass="cta"></asp:TextBox>
                            <asp:Label ID="CVV" runat="server" Text="CVV: " CssClass="select-label"></asp:Label>
                            <asp:TextBox ID="CVVBox" runat="server" CssClass="cta"></asp:TextBox>
                            <asp:Button ID="Pay" runat="server" Text="Pay" CssClass="cta" OnClick="Pay_Click"/>
                        </div>
                    </div>
                </form>
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

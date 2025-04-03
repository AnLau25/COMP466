<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="pay.aspx.cs" Inherits="TMA3a.part3.pay" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
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
                    <a href="/part3/part3.aspx">
                        <h1><span>The</span> PC <span style="font-size:small;">store</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="/part3/part3.aspx/#pcs" data-after="PCs">Browse computers</a></li>
                        <li><a href="/part3/comps.aspx" data-after="components">Browse components</a></li>
                        <li><a href="#footer" data-after="Unit1">Contact us</a></li>
                        <!--<li><a href="#q3" data-after="unit3">Cart</a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->
    <section>
        <div class="section-container">
            <div class="top">
                <h1 class="section-title"><span>Costumize</span> your choice</h1>
                <p class="section-subtitle">Carefull, different components might make your price vary</p>
            </div>
            <div class="pay">
                <form id="form1" runat="server">
                    <div class="select-comps">
                        <asp:Label ID="Pchoice" runat="server" CssClass="section-title">-</asp:Label>
                        <asp:Label ID="Label1" runat="server" Text="RAM" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="DropDownList1" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="Label2" runat="server" Text="Hard Drives" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="DropDownList2" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="Label3" runat="server" Text="CPUs" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="DropDownList3" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="Label4" runat="server" Text="Displays" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="DropDownList4" runat="server" CssClass="cta"></asp:DropDownList>
                        <asp:Label ID="Label5" runat="server" Text="Sound Cards" CssClass="select-label"></asp:Label>
                        <asp:DropDownList ID="DropDownList5" runat="server" CssClass="cta"></asp:DropDownList>
                    </div>

                    <div class="payement">
                        <asp:Label ID="Price" runat="server" CssClass="select-label">-</asp:Label>
                        <asp:Label ID="Label6" runat="server" Text="First Name:" CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="TextBox1" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Label ID="Label7" runat="server" Text="Last Name:" CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="TextBox2" runat="server" CssClass="cta"></asp:TextBox>                  
                        <asp:Label ID="Label8" runat="server" Text="Address: " CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="TextBox3" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Label ID="Label9" runat="server" Text="E-mail: " CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="TextBox4" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Label ID="Label10" runat="server" Text="Credit Card Number: " CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="TextBox5" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Label ID="Label11" runat="server" Text="CVV: " CssClass="select-label"></asp:Label>
                        <asp:TextBox ID="TextBox6" runat="server" CssClass="cta"></asp:TextBox>
                        <asp:Button ID="Button1" runat="server" Text="Pay" CssClass="cta" OnClick="Button1_Click" />
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let basePrices = {
                1: 14.99,
                2: 94,
                3: 295,
                4: 714.99,
                5: 459
            };

            function updatePrice() {
                let basePrice = basePrices[parseInt(new URLSearchParams(window.location.search).get("pc"))] || 0;
                let total = basePrice;

                let dropdowns = document.querySelectorAll("select.cta");
                dropdowns.forEach(dropdown => {
                    let selectedOption = dropdown.options[dropdown.selectedIndex];
                    if (selectedOption) {
                        total += parseInt(selectedOption.value) || 0;
                    }
                });

                document.getElementById("<%= Price.ClientID %>").innerText = "Total Price: $" + total;
            }

            document.querySelectorAll("select.cta").forEach(dropdown => {
                dropdown.addEventListener("change", updatePrice);
            });

            updatePrice();
        });
    </script>
</body>
</html>

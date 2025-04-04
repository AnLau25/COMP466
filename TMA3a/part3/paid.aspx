<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="paid.aspx.cs" Inherits="TMA3a.part3.paid" %>

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


    <!-- Paid section -->
    <section id="comps">
        <div class="section-container">
            <div class="top">
                <h1 class="section-title">Here's your<span> bill</span></h1>
                <p class="section-subtitle">Thank you for shopping with us!</p>
            </div>
            <div class="bill">
                <form id="form2" runat="server">
                    <asp:Label ID="LabelComputerChoice" runat="server"  CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelRAM" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelHDD" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelCPU" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelDisplay" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelSoundCard" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelFirstName" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelLastName" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelAddress" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelEmail" runat="server" CssClass="bill-label" Text="-" />
                    <asp:Label ID="LabelFinalPrice" runat="server" CssClass="bill-label" Text="-" />
                </form>
                <a href="/part3/part3.aspx" type="button" class="cta">Back to home</a>
            </div>
        </div>
    </section>
</body>
</html>

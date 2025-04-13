<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Comps.aspx.cs" Inherits="CompBuyForm.WebForm1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <asp:Label Text="Name:" runat="server" />
        <asp:TextBox ID="Name" runat="server" placeholder="Input your first name"></asp:TextBox>
        <asp:Label Text="Last Name:" runat="server" />
        <asp:TextBox ID="LName" runat="server" placeholder="Input your last name"></asp:TextBox>
        <asp:Label Text="Address:" runat="server" />
        <asp:TextBox ID="Addr" runat="server" placeholder="Input your address"></asp:TextBox>
        <asp:Label Text="E-mail:" runat="server" />
        <asp:TextBox ID="Mail" runat="server" placeholder="Input your e-mail"></asp:TextBox>
        <asp:DropDownList ID="PC" runat="server" AutoPostBack="true">
            <asp:ListItem Text="Computer type 1" Value="250"/>
            <asp:ListItem Text="Computer type 2" Value="200"/>
        </asp:DropDownList>
        <asp:DropDownList ID="Comps" runat="server" AutoPostBack="true">
            <asp:ListItem Text="Component type 1" Value="50"/>
            <asp:ListItem Text="Component type 2" Value="40"/>
        </asp:DropDownList>
        <asp:Label ID="Total" Text="Total:" runat="server" />
        <asp:Button ID="Buy" Text="Buy" runat="server" OnClick="On_Submit"/>
        <asp:Label ID="Err" runat="server"/>
    </form>
</body>
</html>
<!--onClick="Buy_Click"-->
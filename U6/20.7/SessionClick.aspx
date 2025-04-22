<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="SessionClick.aspx.cs" Inherits="MailBook.SessionClick" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <h1>Your visits will apear shortly</h1>
    <form id="form1" runat="server">
        <p style="display:flex;flex-direction:column;">
            <asp:Label runat="server" ID="Sess"/>
            <asp:Label runat="server" ID="IP"/>
            <asp:Label runat="server" ID="TimeZone"/>
        </p>
    </form>
</body>
</html>

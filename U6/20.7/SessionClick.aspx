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
        
        <asp:Label runat="server" Text="Number M: "/>
        <asp:TextBox runat="server" ID="M" Placeholder="Input an integer"/>
        <asp:RequiredFieldValidator runat="server" ControlToValidate="M" ErrorMessage="M is needed"/>
        <asp:RegularExpressionValidator runat="server" ControlToValidate="M" ErrorMessage="M must be an integer" ValidationExpression="^\d+$" />
        <asp:Label runat="server" Text="Number N: "/>
        <asp:TextBox runat="server" ID="N" PLaceholder="Input an integer"/>
        <asp:RequiredFieldValidator runat ="server" ControlToValidate="N" ErrorMessage="N is needed"/>
        <asp:RegularExpressionValidator runat="server" ControlToValidate="N" ErrorMessage="N must be an integer" ValidationExpression="^\d+$" />
        <br/>
        <asp:Button runat="server" ID="GCD" Text="Get GCD" OnClick="GetGCD"/>
        <asp:ValidationSummary runat="server" ForeColor="Red" />
        <br/>
        <asp:Label runat="server" ID="OutGCD"/>
    </form>
</body>
</html>

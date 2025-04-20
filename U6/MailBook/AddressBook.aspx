<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="AddressBook.aspx.cs" Inherits="MailBook.AddressBook" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <p>
            <asp:Label runat="server" Text="Receivers name: "/>
            <asp:TextBox ID="Name" Width="250px" runat="server" placeholder="Name here"/>
            <asp:RequiredFieldValidator ID="nullName" runat="server" ControlToValidate="Name" ErrorMessage="Name is required"/>
        </p>    
        <p>
            <asp:Label runat="server" Text="Receivers e-mail: "/>
            <asp:Textbox ID="Email" Width="250px" runat="server" placeholder="E-mail format thing@domain.extension"/>
            <asp:RequiredFieldValidator ID="nullMail" runat="server" ControlToValidate="Email" ErrorMessage="Email is required"/>
            <asp:RegularExpressionValidator ID="regexMail" runat="server" ControlToValidate="Email" ErrorMessage="Invalid email format" ValidationExpression="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*" />
        </p>
        <p style="display:flex;flex-direction:column;">
            <asp:Label runat="server" Text="Message: "/>
            <asp:TextBox ID="Msg" TextMode="MultiLine" Width="250px" Height="250px" runat="server" placeholder="Write your message"/>
            <asp:RequiredFieldValidator ID="nullMsg" runat="server" ControlToValidate="Msg" ErrorMessage="Message is required" /> 
        </p>

        <p>
            <asp:Button ID="sender" runat="server" Text="Send" OnClick="Send"/>
            <asp:ValidationSummary ID="vsSummary" runat="server" ForeColor="Red" />
        </p>

        <p style="display:flex;flex-direction:column;">
            <asp:Label ID="showName" runat="server"/>
            <asp:Label ID="showMail" runat="server"/>
            <asp:Label ID="showMessage" runat="server" Width="250px" TextMode="Multiline"/>
        </p>
    </form>
</body>
</html>

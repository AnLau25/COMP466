<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="End.aspx.cs" Inherits="CompBuyForm.End" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <h1>Here is your order</h1>
    <form id="form1" runat="server">
        <p>
            <asp:Label ID="FName" runat="server" Text="-"/>
        </p>
        <p>
            <asp:Label ID="LName" runat="server" Text="-"/>
        </p>
        <p>
            <asp:Label ID="Addr" runat="server" Text="-"/>
        </p>
        <p>
            <asp:Label ID="Mail" runat="server" Text="-" />
        </p>
        <p>
            <asp:Label ID="PC" runat="server" Text="-" />
        </p>
        <p>
            <asp:Label ID="Comps" runat="server" Text="-" />
        </p>
        <p>
            <asp:Label ID="Price" runat="server" Text="-" />
        </p>
        <p>
            <asp:Label ID="IP" runat="server" Text="-" />
        </p>
    </form>
</body>
    <script>

    </script>
</html>

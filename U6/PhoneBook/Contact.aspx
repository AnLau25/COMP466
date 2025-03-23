<div>
    <h1>Phone Book</h1>
    <form id="form1" runat="server">
        <p>Add and entry to the phone book:</p>
        <asp:Label ID="Label1" runat="server" Text="Last name: "></asp:Label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:TextBox ID="txtlastName" runat="server"></asp:TextBox>
        <br />
        <asp:Label ID="Label2" runat="server" Text="First name: "></asp:Label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:TextBox ID="txtfirstName" runat="server"></asp:TextBox>
        <br />
        <asp:Label ID="Label3" runat="server" Text="Phone number: "></asp:Label>
    &nbsp;<asp:TextBox ID="txtnum" runat="server"></asp:TextBox>
        <br />
        <br />
        <asp:Button ID="Add" runat="server" Text="Add Phone Book Entry" />
        <br />
        <br />
        <p>Locate entries in the phone book:<p>
        <asp:Label ID="Label4" runat="server" Text="Last name: "></asp:Label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:TextBox ID="findLast" runat="server"></asp:TextBox>
        <br />
        <br />
        <asp:Button ID="Find" runat="server" Text="Find Entries by Last Name" />
        <br />
        <br />
        <asp:Label ID="Label5" runat="server" Text="Results:"></asp:Label>
        <br />
        <asp:ListBox ID="ListBox1" runat="server" Height="207px" Width="385px"></asp:ListBox>
    </form>

</div>
<!--The better way was with a table for formatting, but aint nobody gots time for that-->

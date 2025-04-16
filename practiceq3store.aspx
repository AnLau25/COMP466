<html>
	<head>
		<title>Computer page</title>
	</head>
	
	<body>
		<form id="form1" runat="server">
			<p>
				<asp:Label runat="server" Text="First name: "/>
				<asp:TextBox runat="server" ID="FName" placehoder="First Name"/>
			</p>

			<p>
				<asp:Label runat="server" Text="Last name: "/>
				<asp:TextBox runat="server" ID="LName" placehoder="Last Name"/>
			</p>


			<p>
				<asp:Label runat="server" Text="Mailing Address: "/>
				<asp:TextBox runat="server" ID="Adr" placehoder="Address"/>
			</p>

			<p>
				<asp:Label runat="Server"  Text="Telephone number: "/>
				<asp:TextBox runat="Server" ID="Phone" placehoder="Phone number"/>
			</p>

			<p>
				<asp:Label runat="Server" Text="Email: "/>
				<asp:TextBox runat="Server" ID="Email" placehoder="Email"/>
			</p>

			<p>
				<asp:Label runat="server" Text="Computer model:"/>
				<asp:DropDownList runat="server" ID="Pc" AutoPostBack="true">
					<asp:ListItem Text="PC Model 1" Value="200"/>
					<asp:ListItem Text="PC Model 2" Value="250"/>
				</asp:DropDownList>
			</p>

			<p>
				<asp:Label runat="server" Text="Component type: "/>
				<asp:DropDownList runat="server" ID="Comp" AutoPostBack="true">
					<asp:ListItem Text="Component Model 1" Value="40"/>
					<asp:ListItem Text="component Model 2" Value="50"/>
				</asp:DropDownList>
			</p>
			
			<p>
				<asp:Label runat="server" ID="Price" Text="-"/>

			</p>

			<p>
				<asp:Button runat="server" Text="Pay" OnClick="Handle_Submit"/>
				<asp:Label runat="server" ID="Err"/>

			</p>
		</form>
	</body>

</html>
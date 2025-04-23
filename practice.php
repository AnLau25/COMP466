<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	echo "<p>Gottcha!</p>";

	$name = $_POST['name']??null;
	$email = $_POST['mail']??null;
	$address = $_POST['adr']??null;

	if (preg_match("/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/", $email)){
		echo "<p>Nice to meet you ".$name."!</p>";
	}else{
		echo "<p>Eh! Input your e-mail right!</p>";
	}


}






?>

<!DOCTYPE html>
<html>
	<head>
		<title>Practice</title>
	</head>

	<body>
		<form method=post>
			<p>
				<lable>Input your name: </lable>
				<input type="textbox" id="name" name="name" placeholder="Input your name" required=true/>
			</p>
			<p>
				<lable>Input your e-mail: </lable>
				<input type="textbox" id="mail" name="mail" placeholder="Input your e-mail" required=true/>
			</p>
			<p>
				<lable>Input your address: </lable>
				<input type="textbox" id="adr" name="adr" placeholder="Input your address" required=true/>
			</p>
			<p>
				<button type="submit" id="sub">Submit</button>
				<button type="reset" id="res">Reset</button>
			</p>
		</form>
	</body>

</html>
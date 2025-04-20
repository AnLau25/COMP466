<?php
	$db = "my_db";
	$host = "my_host";
	$user = "me";
	$pswrd = "my_pasword";
	
	$database = mysqli_connect($host, $user, $pswrd, $db);

	if($database->error){
		die("Connection error:".$database->connect_error);	
	}
	echo "";

	$sql = "INSERT INTO Urltable (link_url, link_description) VALUES (?, ?)";
	$stmt = mysqli_prepare($database, $sql);

	if($stmt){
		mysqli_stmt_bind_param($stmt, "sss", $url, $desc);

		$url = "www.deitel.com";
		$desc = "Course web";
		mysqli_stmt_execute($stmt);

		$url = 	"www.php.net";
		$desc = "PHP site";

		$display_sql = "SELECT link_url, link_description FROM Urltable";
		$result = mysqli_query($database,$display_sql);

		while ($row = mysqli_fetch_assoc($result)){
			echo '<a href="'.$row['link_url'].'">'.$row['link_description'].'</a>'
		}
		
		mysqli_stmt_close($stmt);
		mysqli_close($database);
	}else{
		echo "Statement preparation failed: ".mysqli_error($databse);
	}
	
?>

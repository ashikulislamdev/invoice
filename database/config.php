<?php

	session_start();

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dataBaseName ="udduktainv";

	$site_url = "http://localhost/php-projects/invoice/";

	$conn = mysqli_connect($serverName, $userName, $password, $dataBaseName);
	if($conn->connect_error){
		die("Database Connection Filed!");
	}
	
?>
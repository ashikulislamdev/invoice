<?php

	session_start();

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dataBaseName ="udduktaInv";

	$site_url = "http://localhost/udduktaInv/";

	$conn = mysqli_connect($serverName, $userName, $password, $dataBaseName);
	if($conn->connect_error){
		die("Database Connection Filed!");
	}

?>
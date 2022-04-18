<?php
	

	$cookie_name =  md5(trim("udduktaInv"));

	if (isset($_COOKIE[$cookie_name])) {
		setcookie($cookie_name,"",time()-(86400 * 7),"/");
		echo "<script>location.href = 'index.php';</script>";
	}else{
		echo "<script>location.href = 'index.php';</script>";
	}


?>
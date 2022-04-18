<?php 

	include "database/config.php";

	$cookie_name =  md5(trim("udduktaInv"));
	
	if (!isset($_COOKIE[$cookie_name])) {
		echo "<script>location.href='index.php'</script>";
		die();
	}else{
		if(isset($_COOKIE[$cookie_name])){
			$currentAuth = $_COOKIE[$cookie_name];
		}
		
		$current_user_id = '';
		$dbAuth = "SELECT * FROM `admin` WHERE `auth` = '$currentAuth'";
		$runAuth = mysqli_query($conn,$dbAuth);
		if(mysqli_num_rows($runAuth) > 0){
			while ($current_user = mysqli_fetch_assoc($runAuth)) {
				$current_user_id = $current_user['id'];
				$current_user_name = $current_user['username'];
			}
		}else{
			echo "<script>location.href='logout.php'</script>";
			die();
		}
	}

?>
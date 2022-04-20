<?php

    include 'session.php';


    if(isset($_POST['customer_name']) && isset($_POST['customer_phone']) && isset($_POST['address'])){
        $customer_name = trim(htmlentities(addslashes($_POST['customer_name'])));
        $customer_phone = trim(htmlentities(addslashes($_POST['customer_phone'])));
        $address = trim(htmlentities(addslashes($_POST['address'])));

        if(!empty($customer_name) && !empty($customer_phone)){
            $sql = "INSERT INTO `customers`(`customer_name`, `customer_phone`, `address`) VALUES ('$customer_name','$customer_phone', '$address')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../customer.php?action=record_added');
            }else{
                header('location: ../customer.php?action=something_wrong');
            }
        }else{
			header('location: ../customer.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>
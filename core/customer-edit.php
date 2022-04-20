<?php

    include 'session.php';


    if(isset($_POST['customer_edit_id']) && isset($_POST['customer_name']) && isset($_POST['customer_phone']) && isset($_POST['address'])){
        $customer_edit_id = trim(htmlentities(addslashes($_POST['customer_edit_id'])));
        $customer_name = trim(htmlentities(addslashes($_POST['customer_name'])));
        $customer_phone = trim(htmlentities(addslashes($_POST['customer_phone'])));
        $address = trim(htmlentities(addslashes($_POST['address'])));

        if(!empty($customer_edit_id) && !empty($customer_name) && !empty($customer_phone)){
            $sql = "UPDATE `customers` SET `customer_name` = '$customer_name', `customer_phone` = '$customer_phone', `address` = '$address' WHERE `id` = '$customer_edit_id'";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../customer.php?action=record_updated');
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
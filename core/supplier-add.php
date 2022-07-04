<?php

    include 'session.php';


    if(isset($_POST['supplier_name']) && isset($_POST['supplier_phone']) && isset($_POST['shop_name']) && isset($_POST['address'])){
        $supplier_name = trim(htmlentities(addslashes($_POST['supplier_name'])));
        $supplier_phone = trim(htmlentities(addslashes($_POST['supplier_phone'])));
        $shop_name = trim(htmlentities(addslashes($_POST['shop_name'])));
        $address = trim(htmlentities(addslashes($_POST['address'])));

        if(!empty($supplier_name) && !empty($supplier_phone) && !empty( $shop_name )){
            $sql = "INSERT INTO `suppliers`(`supplier_name`, `supplier_phone`, `shop_name`, `address`) VALUES ('$supplier_name','$supplier_phone','$shop_name', '$address')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../supplier.php?action=record_added');
            }else{
                header('location: ../supplier.php?action=something_wrong');
            }
        }else{
			header('location: ../supplier.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>
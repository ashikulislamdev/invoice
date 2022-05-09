<?php

    include 'session.php';


    if(isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['supplier_price']) && isset($_POST['sale_price']) && isset($_POST['voucher_no']) && isset($_POST['supplier_id']) && isset($_POST['warranty_days']) && isset($_POST['product_details'])){
        
        $name = trim(htmlentities(addslashes($_POST['name'])));
        $quantity = trim(htmlentities(addslashes($_POST['quantity'])));
        $supplier_price = trim(htmlentities(addslashes($_POST['supplier_price'])));
        $sale_price = trim(htmlentities(addslashes($_POST['sale_price'])));
        $voucher_no = trim(htmlentities(addslashes($_POST['voucher_no'])));
        $supplier_id = trim(htmlentities(addslashes($_POST['supplier_id'])));
        $warranty_days = trim(htmlentities(addslashes($_POST['warranty_days'])));
        $product_details = trim(htmlentities(addslashes($_POST['product_details'])));

        if(!empty($name) && !empty($quantity) && !empty($quantity) && !empty($supplier_price) && !empty($sale_price) && !empty($voucher_no) && !empty($supplier_id) && !empty($warranty_days)){
            $sql = "INSERT INTO `products`(`name`, `quantity`, `supplier_price`, `sale_price`, `voucher_no`, `supplier_id`, `warranty_days`, `product_details`) VALUES ('$name','$quantity', '$supplier_price', '$sale_price', '$voucher_no', '$supplier_id', '$warranty_days', '$product_details')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../products.php?action=record_added');
            }else{
                header('location: ../products.php?action=something_wrong');
            }
        }else{
			header('location: ../products.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>
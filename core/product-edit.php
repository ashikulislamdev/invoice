<?php

    include 'session.php';


    if(isset($_POST['product_edit_id']) && isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['supplier_price']) && isset($_POST['sale_price']) && isset($_POST['voucher_no']) && isset($_POST['supplier_id']) && isset($_POST['warranty_days'])){

        $product_edit_id = trim(htmlentities(addslashes($_POST['product_edit_id'])));
        $name = trim(htmlentities(addslashes($_POST['name'])));
        $quantity = trim(htmlentities(addslashes($_POST['quantity'])));
        $supplier_price = trim(htmlentities(addslashes($_POST['supplier_price'])));
        $sale_price = trim(htmlentities(addslashes($_POST['sale_price'])));
        $voucher_no = trim(htmlentities(addslashes($_POST['voucher_no'])));
        $supplier_id = trim(htmlentities(addslashes($_POST['supplier_id'])));
        $warranty_days = trim(htmlentities(addslashes($_POST['warranty_days'])));

        if(!empty($product_edit_id) && !empty($name) && !empty($quantity) && !empty($supplier_price) && !empty($sale_price) && !empty($voucher_no) && !empty($supplier_id) && !empty($warranty_days)){
            $sql = "UPDATE `products` SET `name` = '$name', `quantity` = '$quantity', `supplier_price` = '$supplier_price', `sale_price` = '$sale_price', `voucher_no` = '$voucher_no', `supplier_id` = '$supplier_id', `warranty_days` = '$warranty_days' WHERE `id` = '$product_edit_id'";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../products.php?action=record_updated');
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
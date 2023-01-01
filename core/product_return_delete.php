<?php

    include 'session.php';

    if(isset($_GET['invoice_id']) && isset($_GET['product_id']) && isset($_GET['invoice_item_id'])){
        
        $invoice_id = trim(htmlentities(addslashes($_GET['invoice_id'])));
        $product_id = trim(htmlentities(addslashes($_GET['product_id'])));
        $invoice_item_id = trim(htmlentities(addslashes($_GET['invoice_item_id'])));

        $invSql = "SELECT * FROM `invoices` WHERE `id` = '$invoice_id'";
        $invSqlQry = mysqli_query($conn, $invSql);
        if(mysqli_num_rows($invSqlQry) == 1){
            $invInfo = mysqli_fetch_assoc($invSqlQry);
        }

        $productSql = "SELECT * FROM `products` WHERE `id` = '$product_id'";
        $productSqlQry = mysqli_query($conn, $productSql);
        if(mysqli_num_rows($productSqlQry) == 1){
            $productInfo = mysqli_fetch_assoc($productSqlQry);
        }

        $invoiceItemSql = "SELECT * FROM `invoice_item` WHERE `id` = '$invoice_item_id' AND `invoice_id` = '$invoice_id' AND `product_id` = '$product_id'";
        $invoiceItemSqlQry = mysqli_query($conn, $invoiceItemSql);
        if(mysqli_num_rows($invoiceItemSqlQry) == 1){
            $invoiceItemInfo = mysqli_fetch_assoc($invoiceItemSqlQry);
        }

        // check invoice exist or not
        if(!isset($invInfo) || !isset($productInfo) || !isset($invoiceItemInfo)){
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '&action=something_wrong');
        }

        $sql = "DELETE FROM `invoice_item` WHERE `id` = '$invoice_item_id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery){
            $total = $invInfo['total'] - $invoiceItemInfo['total'];
            $total_supplier_price = $invInfo['total_supplier_price'] - $invoiceItemInfo['total_supplier_price'];
            $pay = $invInfo['pay'];
            if($invInfo['pay'] >= $invoiceItemInfo['total']){
                $pay = $invInfo['pay'] - $invoiceItemInfo['total'];
            }
            $invoiceUpdate = mysqli_query($conn, "UPDATE `invoices` SET `total` = '$total', `total_supplier_price` = '$total_supplier_price', `pay` = '$pay' WHERE `id` = '$invoice_id'");
            
            if($invoiceUpdate){
                $quantity = $productInfo['quantity'] + $invoiceItemInfo['quantity'];
                $productUpdate = mysqli_query($conn, "UPDATE `products` SET `quantity` = '$quantity' WHERE `id` = '$product_id'");
                if($productUpdate){
                    header('Location: ' . $_SERVER['HTTP_REFERER'] . '&action=record_updated');
                }else{
                    header('Location: ' . $_SERVER['HTTP_REFERER'] . '&action=something_wrong');
                }
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER'] . '&action=something_wrong');
            }

        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '&action=something_wrong');
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
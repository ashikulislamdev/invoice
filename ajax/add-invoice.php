<?php

    include 'session.php';

    if(isset($_POST['customer_id']) && isset($_POST['product_id']) && isset($_POST['product_quantity']) && isset($_POST['total_price']) && isset($_POST['invoice_date']) && isset($_POST['total_discount']) && isset($_POST['grand_total']) && isset($_POST['paid_amount']) && isset($_POST['due_amount'])){
        $customer_id = trim(htmlentities(addslashes($_POST['customer_id'])));
        $invoice_date = trim(htmlentities(addslashes($_POST['invoice_date'])));
        $total_discount = trim(htmlentities(addslashes($_POST['total_discount'])));
        $grand_total = trim(htmlentities(addslashes($_POST['grand_total'])));
        $paid_amount = trim(htmlentities(addslashes($_POST['paid_amount'])));
        $due_amount = trim(htmlentities(addslashes($_POST['due_amount'])));

        if(!empty($customer_id) || !empty($invoice_date) || !empty($grand_total)){


            $sql = "INSERT INTO `invoices` (`customer_id`, `discount`, `pay`, `due`, `total`, `created`) VALUES('$customer_id', '$total_discount', '$paid_amount', '$due_amount', '$grand_total', '$invoice_date')";
            $runSql = mysqli_query($conn, $sql);
            if($runSql){

                $sql1 = "SELECT * FROM `invoices` ORDER BY `id` DESC LIMIT 1";
				$query1 = mysqli_query($conn, $sql1);
				if (mysqli_num_rows($query1) > 0 ) {
					while ($row = mysqli_fetch_array($query1)) {
						$invoice_id = $row['id'];
					}
				}else{
					$invoice_id = 1;
				}

                
                $productCount = count($_POST['product_id']);
                $runSql2 = '';


                for ($i=0; $i < $productCount; $i++) {
                    $product_id = $_POST['product_id'][$i];
                    $quantity = $_POST['product_quantity'][$i];
                    $total = $_POST['total_price'][$i];
                    
                    
                    $selectSql = "SELECT `quantity` FROM `products` WHERE `id` = $product_id ORDER BY `id` LIMIT 1";
                    $runSelectSql = mysqli_query($conn, $selectSql);
                    if($runSelectSql && mysqli_num_rows($runSelectSql) > 0){
                        while($row = mysqli_fetch_assoc($runSelectSql)){
                            $product_quantity = $row['quantity'] - $quantity;

                            $updateSql = "UPDATE `products` SET `quantity` = '$product_quantity' WHERE `id` = '$product_id'";
                            $runUpdateSql = mysqli_query($conn, $updateSql);
                            if($runUpdateSql){
                                $sql2 = "INSERT INTO `invoice_item` (`invoice_id`, `product_id`, `quantity`, `total`) VALUES('$invoice_id', '$product_id', '$quantity', '$total')";
                                $runSql2 = mysqli_query($conn, $sql2);
                            }
                        }
                    }
                }

                if($runSql2){
                    // echo "<h5 class='text-success'>Invoice added successfully..!</h5>";
                    echo "<script>location.href='invoice-details.php?invoice_id=$invoice_id';</script>";
                }else{
                    echo "<h5 class='text-danger'>Oops, Sorry something wrong..!</h5>";
                }


            }else{
                echo "<h5 class='text-danger'>Oops, Invoice Information doesn't store..!</h5>";
            }

        }else{
            echo "<h5 class='text-danger'>Attention, All field are required..!</h5>";
        }
    }else{
        echo "<h5 class='text-danger'>Sorry, Something Wrong..!</h5>";
    }

?>
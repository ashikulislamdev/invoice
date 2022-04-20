<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $customersSql = "SELECT * FROM `customers` ORDER BY `id` DESC";

    $runCustomersSql = mysqli_query($conn, $customersSql);
    $customerCount = mysqli_num_rows($runCustomersSql);
    if($runCustomersSql && $customerCount > 0){
        while ($customersRow = mysqli_fetch_assoc($runCustomersSql)) {
            $customersData[] = $customersRow;
        }
    }



?>
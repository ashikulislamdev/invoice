<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $suppliersSql = "SELECT * FROM `suppliers` ORDER BY `id` DESC";

    $runSuppliersSql = mysqli_query($conn, $suppliersSql);
    $supplierCount = mysqli_num_rows($runSuppliersSql);
    if($runSuppliersSql && $supplierCount > 0){
        while ($suppliersRow = mysqli_fetch_assoc($runSuppliersSql)) {
            $suppliersData[] = $suppliersRow;
        }
    }



?>
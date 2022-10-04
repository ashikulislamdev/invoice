<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $supplier_id = 0;

    if(isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])){
        $supplier_id = htmlentities(addslashes($_GET['supplier_id']));
    }

    $supplierAccountSql = "SELECT * FROM `supplier_account` WHERE `supplier_id` = $supplier_id";

    $runSupplierAccountSql = mysqli_query($conn, $supplierAccountSql);
    $supplierAccountCount = mysqli_num_rows($runSupplierAccountSql);
    if($runSupplierAccountSql && $supplierAccountCount > 0){
        while ($supplierAccountRow = mysqli_fetch_assoc($runSupplierAccountSql)) {
            $supplierAccountData[] = $supplierAccountRow;
        }
    }



?>
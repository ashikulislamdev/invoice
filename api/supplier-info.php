<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $supplier_id = 0;

    if(isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])){
        $supplier_id = htmlentities(addslashes($_GET['supplier_id']));
    }

    $supplierInfoSql = "SELECT * FROM `suppliers` WHERE `id` = $supplier_id";

    $runSupplierInfoSql = mysqli_query($conn, $supplierInfoSql);
    $supplierCount = mysqli_num_rows($runSupplierInfoSql);
    if($runSupplierInfoSql && $supplierCount == 1){
        $supplierInfo = mysqli_fetch_assoc($runSupplierInfoSql);
    }

?>
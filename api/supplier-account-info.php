<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $id = 0;

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = htmlentities(addslashes($_GET['id']));
    }

    $supplierAccountInfoSql = "SELECT * FROM `supplier_account` WHERE `id` = $id";

    $runSupplierAccountInfoSql = mysqli_query($conn, $supplierAccountInfoSql);$runSupplierAccountCount = mysqli_num_rows($runSupplierAccountInfoSql);
    if($runSupplierAccountInfoSql && $runSupplierAccountCount == 1){
        $supplierAccountInfo = mysqli_fetch_assoc($runSupplierAccountInfoSql);
    }

?>
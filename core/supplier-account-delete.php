<?php

    include "session.php";

    if(isset($_GET['id']) && isset($_GET['supplier_id'])){
        
        $id = trim(htmlentities(addslashes($_GET['id'])));
        $supplier_id = trim(htmlentities(addslashes($_GET['supplier_id'])));

        $sql = "DELETE FROM `supplier_account` WHERE `id` = '$id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery == TRUE){
            echo "<script>location.href='../supplier-account.php?supplier_id=".$supplier_id."&action=details&response=record_deleted';</script>";
        }else{
            echo "<script>location.href='../supplier-account.php?supplier_id=".$supplier_id."&action=details&response=something_wrong';</script>";
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
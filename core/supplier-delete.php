<?php

    include "session.php";

    if(isset($_GET['supplier_id'])){
        
        $id = trim(htmlentities(addslashes($_GET['supplier_id'])));

        $sql = "DELETE FROM `suppliers` WHERE `id` = '$id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery == TRUE){
            echo "<script>location.href='../supplier.php?record_deleted';</script>";
        }else{
            echo "<script>location.href='../supplier.php?something_wrong';</script>";
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
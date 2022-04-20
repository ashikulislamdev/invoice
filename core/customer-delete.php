<?php

    include "session.php";

    if(isset($_GET['customer_id'])){
        
        $id = trim(htmlentities(addslashes($_GET['customer_id'])));

        $sql = "DELETE FROM `customers` WHERE `id` = '$id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery == TRUE){
            echo "<script>location.href='../customer.php?action=record_deleted';</script>";
        }else{
            echo "<script>location.href='../customer.php?action=something_wrong';</script>";
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
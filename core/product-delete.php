<?php

    include "session.php";

    if(isset($_GET['product_id'])){
        
        $id = trim(htmlentities(addslashes($_GET['product_id'])));

        $sql = "DELETE FROM `products` WHERE `id` = '$id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery == TRUE){
            echo "<script>location.href='../products.php?action=record_deleted';</script>";
        }else{
            echo "<script>location.href='../products.php?action=something_wrong';</script>";
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
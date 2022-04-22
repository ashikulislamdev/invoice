<?php

    include "session.php";

    if(isset($_GET['cost_id'])){
        
        $id = trim(htmlentities(addslashes($_GET['cost_id'])));

        $sql = "DELETE FROM `cost` WHERE `id` = '$id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery == TRUE){
            echo "<script>location.href='../cost.php?action=record_deleted';</script>";
        }else{
            echo "<script>location.href='../cost.php?action=something_wrong';</script>";
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
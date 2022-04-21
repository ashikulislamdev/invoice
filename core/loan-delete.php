<?php

    include "session.php";

    if(isset($_GET['loan_id'])){
        
        $id = trim(htmlentities(addslashes($_GET['loan_id'])));

        $sql = "DELETE FROM `loan` WHERE `id` = '$id'";
        $sqlQuery = mysqli_query($conn, $sql);

        if($sqlQuery == TRUE){
            echo "<script>location.href='../loan.php?action=record_deleted';</script>";
        }else{
            echo "<script>location.href='../loan.php?action=something_wrong';</script>";
        }
        
    }else{
        echo "Sorry, Something Wrong..!";
    }

?>
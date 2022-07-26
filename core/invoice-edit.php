<?php

    include 'session.php';


    if(isset($_POST['invoice_id']) && isset($_POST['pay'])){
        $invoice_id = trim(htmlentities(addslashes($_POST['invoice_id'])));
        $pay = trim(htmlentities(addslashes($_POST['pay'])));
        
        if(!empty($invoice_id) && !empty($pay) ){

            if($pay < 1 ){ die('you cannot input less than 0 value'); }

            $InvFindSql = "SELECT * FROM `invoices` WHERE `id` = '$invoice_id'";
            $InvSqlQuery = mysqli_query($conn, $InvFindSql);
            if(mysqli_num_rows($InvSqlQuery) == 1){
                $invInfo = mysqli_fetch_assoc($InvSqlQuery);
            }

            if(!isset($invInfo)){
                die('Invoice information not found..!');
            }

            if($pay > $invInfo['total']){
                die("You cannot pay more than the total amount");
            }

            $due = $invInfo['total']  - $pay;

            
            $sql = "UPDATE `invoices` SET  `pay` = '$pay', `due` = '$due' WHERE `id` = '$invoice_id'";
            //die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../invoice.php?action=record_updated');
            }else{
                header('location: ../invoice.php?action=something_wrong');
            }
        }else{
			header('location: ../invoice.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>
<?php

    include 'session.php';


    if(isset($_POST['id']) && isset($_POST['supplier_id']) && isset($_POST['buy_amount']) && isset($_POST['voucher_no']) && isset($_POST['date']) && isset($_POST['details'])){
        $id = trim(htmlentities(addslashes($_POST['id'])));
        $supplier_id = trim(htmlentities(addslashes($_POST['supplier_id'])));
        $buy_amount = trim(htmlentities(addslashes($_POST['buy_amount'])));
        $voucher_no = trim(htmlentities(addslashes($_POST['voucher_no'])));
        $date = trim(htmlentities(addslashes($_POST['date'])));
        $details = trim(htmlentities(addslashes($_POST['details'])));

        if(!empty($id) && !empty($supplier_id) && !empty($buy_amount) && !empty($date)){

            if($buy_amount < 0){ die('you cannot input less than 0 value'); }

            $sql = "UPDATE `supplier_account` SET `buy_amount`='$buy_amount',`voucher_no`='$voucher_no',`date`='$date',`details`='$details' WHERE `id` = $id";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=details&response=record_updated');
            }else{
                header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=buy&response=something_wrong&id='.$id);
            }
        }else{
			header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=buy&response=null&id='.$id);
		}
    }else{
        echo "something wrong...!";
    }

?>
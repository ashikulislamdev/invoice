<?php

    include 'session.php';


    if(isset($_POST['supplier_id']) && isset($_POST['buy_amount']) && isset($_POST['voucher_no']) && isset($_POST['date']) && isset($_POST['details'])){
        $supplier_id = trim(htmlentities(addslashes($_POST['supplier_id'])));
        $buy_amount = trim(htmlentities(addslashes($_POST['buy_amount'])));
        $voucher_no = trim(htmlentities(addslashes($_POST['voucher_no'])));
        $date = trim(htmlentities(addslashes($_POST['date'])));
        $details = trim(htmlentities(addslashes($_POST['details'])));

        if(!empty($supplier_id) && !empty($buy_amount) && !empty($date)){

            if($buy_amount < 0){ die('you cannot input less than 0 value'); }

            $sql = "INSERT INTO `supplier_account`(`supplier_id`, `buy_amount`, `voucher_no`, `date`, `details`) VALUES ('$supplier_id','$buy_amount','$voucher_no','$date', '$details')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=details&response=record_added');
            }else{
                header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=buy&response=something_wrong');
            }
        }else{
			header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=buy&response=null');
		}
    }else{
        echo "something wrong...!";
    }

?>
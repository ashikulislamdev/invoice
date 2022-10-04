<?php

    include 'session.php';


    if(isset($_POST['supplier_id']) && isset($_POST['pay_amount']) && isset($_POST['date']) && isset($_POST['details'])){
        $supplier_id = trim(htmlentities(addslashes($_POST['supplier_id'])));
        $pay_amount = trim(htmlentities(addslashes($_POST['pay_amount'])));
        $date = trim(htmlentities(addslashes($_POST['date'])));
        $details = trim(htmlentities(addslashes($_POST['details'])));

        if(!empty($supplier_id) && !empty($pay_amount) && !empty($date)){

            if($pay_amount < 0){ die('you cannot input less than 0 value'); }

            $sql = "INSERT INTO `supplier_account`(`supplier_id`, `pay_amount`, `date`, `details`) VALUES ('$supplier_id','$pay_amount','$date', '$details')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=details&response=record_added');
            }else{
                header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=pay&response=something_wrong');
            }
        }else{
			header('location: ../supplier-account.php?supplier_id='.$supplier_id.'&action=pay&response=null');
		}
    }else{
        echo "something wrong...!";
    }

?>
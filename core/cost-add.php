<?php

    include 'session.php';


    if(isset($_POST['title']) && isset($_POST['amount']) && isset($_POST['cost_type']) && isset($_POST['cost_date']) && isset($_POST['note'])){
        $title = trim(htmlentities(addslashes($_POST['title'])));
        $amount = trim(htmlentities(addslashes($_POST['amount'])));
        $cost_type = trim(htmlentities(addslashes($_POST['cost_type'])));
        $cost_date = trim(htmlentities(addslashes($_POST['cost_date'])));
        $note = trim(htmlentities(addslashes($_POST['note'])));

        if(!empty($title) && !empty($amount) && !empty( $cost_date )){

            if($amount < 0){ die('you cannot input less than 0 value'); }

            $sql = "INSERT INTO `cost`(`title`, `amount`, `cost_type`, `cost_date`, `note`) VALUES ('$title','$amount','$cost_type','$cost_date', '$note')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../cost.php?action=record_added');
            }else{
                header('location: ../cost.php?action=something_wrong');
            }
        }else{
			header('location: ../cost.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>
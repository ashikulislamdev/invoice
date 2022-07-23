<?php

    include 'session.php';


    if(isset($_POST['title']) && isset($_POST['amount']) && isset($_POST['date']) && isset($_POST['note']) && isset($_POST['type'])){
        $title = trim(htmlentities(addslashes($_POST['title'])));
        $amount = trim(htmlentities(addslashes($_POST['amount'])));
        $date = trim(htmlentities(addslashes($_POST['date'])));
        $note = trim(htmlentities(addslashes($_POST['note'])));
        $type = trim(htmlentities(addslashes($_POST['type'])));

        if(!empty($title) && !empty($amount) && !empty($date) && !empty($type)){

            if($amount < 0){ die('you cannot input less than 0 value'); }

            $sql = "INSERT INTO `loan`(`title`, `amount`, `date`, `note`, `type`) VALUES ('$title','$amount','$date', '$note', '$type')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../loan.php?action=record_added');
            }else{
                header('location: ../loan.php?action=something_wrong');
            }
        }else{
			header('location: ../loan.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>
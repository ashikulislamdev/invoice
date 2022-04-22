<?php

    include 'session.php';


    if(isset($_POST['title']) && isset($_POST['amount']) && isset($_POST['date']) && isset($_POST['note'])){
        $title = trim(htmlentities(addslashes($_POST['title'])));
        $amount = trim(htmlentities(addslashes($_POST['amount'])));
        $date = trim(htmlentities(addslashes($_POST['date'])));
        $note = trim(htmlentities(addslashes($_POST['note'])));

        if(!empty($title) && !empty($amount) && !empty( $date )){

            if($amount < 0){ die('you cannot input less than 0 value'); }

            $sql = "INSERT INTO `cost`(`title`, `amount`, `date`, `note`) VALUES ('$title','$amount','$date', '$note')";
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
<?php

    include 'session.php';


    if(isset($_POST['cost_edit_id']) && isset($_POST['title']) && isset($_POST['amount']) && isset($_POST['date']) && isset($_POST['note'])){
        $cost_edit_id = trim(htmlentities(addslashes($_POST['cost_edit_id'])));
        $title = trim(htmlentities(addslashes($_POST['title'])));
        $amount = trim(htmlentities(addslashes($_POST['amount'])));
        $date = trim(htmlentities(addslashes($_POST['date'])));
        $note = trim(htmlentities(addslashes($_POST['note'])));

        if(!empty($cost_edit_id) && !empty($title) && !empty($amount) && !empty($date)){

            if($amount < 0){ die('you cannot input less than 0 value'); }

            
            $sql = "UPDATE `cost` SET `title` = '$title', `amount` = '$amount', `date` = '$date', `note` = '$note' WHERE `id` = '$cost_edit_id'";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                header('location: ../cost.php?action=record_updated');
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
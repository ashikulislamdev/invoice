<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $loanSql = "SELECT * FROM `loan` ORDER BY `id` DESC";

    $runLoanSql = mysqli_query($conn, $loanSql);
    $loanCount = mysqli_num_rows($runLoanSql);
    if($runLoanSql && $loanCount > 0){
        while ($loanRow = mysqli_fetch_assoc($runLoanSql)) {
            $loanData[] = $loanRow;
        }
    }



?>
<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $costSql = "SELECT * FROM `cost` ORDER BY `id` DESC";

    $runCostSql = mysqli_query($conn, $costSql);
    $costCount = mysqli_num_rows($runCostSql);
    if($runCostSql && $costCount > 0){
        while ($costRow = mysqli_fetch_assoc($runCostSql)) {
            $costData[] = $costRow;
        }
    }



?>
<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $productsSql = "SELECT * FROM `products` ORDER BY `id` DESC";

    $runProductsSql = mysqli_query($conn, $productsSql);
    $productCount = mysqli_num_rows($runProductsSql);
    if($runProductsSql && $productCount > 0){
        while ($productsRow = mysqli_fetch_assoc($runProductsSql)) {
            $productsData[] = $productsRow;
        }
    }



?>
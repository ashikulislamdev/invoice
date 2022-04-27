<?php

    include 'session.php';

    $result = ['status'=>false, 'collection'=>null];
    $data = [];

    $Sql = "SELECT * FROM `products` ORDER BY `id` DESC";

    $runSql = mysqli_query($conn, $Sql);
    $productCount = mysqli_num_rows($runSql);
    if($runSql && $productCount > 0){
        while ($row = mysqli_fetch_assoc($runSql)) {
            $data[] = $row;
        }
        $result = ['status'=>true, 'collection'=>$data];
    }

    echo json_encode($result);
?>
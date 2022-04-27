<?php 

    include 'session.php';
    
    $result = ['status'=>false, 'collection'=>null];

    if(isset($_POST['customer_id'])){
        $customer_id = trim(htmlentities(addslashes($_POST['customer_id'])));

        $sql = "SELECT * FROM `customers` WHERE `id` = '$customer_id'";
        $runSql = mysqli_query($conn, $sql);
        if($runSql && mysqli_num_rows($runSql) > 0){
            $data = mysqli_fetch_assoc($runSql);

            $result = ['status'=>true, 'collection'=>$data];
        }
    }

    echo json_encode($result);
?>
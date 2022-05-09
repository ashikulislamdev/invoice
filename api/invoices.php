<?php



    if(!isset($current_user_id)){die('Unauthorized Error');}

    $invoiceSql = "SELECT * FROM `invoices` ORDER BY `id` DESC";

    $runInvoiceSql = mysqli_query($conn, $invoiceSql);
    $productCount = mysqli_num_rows($runInvoiceSql);
    if($runInvoiceSql && $productCount > 0){
        while ($invoiceRow = mysqli_fetch_assoc($runInvoiceSql)) {
            $invoiceData[] = $invoiceRow;
        }
    }

?>
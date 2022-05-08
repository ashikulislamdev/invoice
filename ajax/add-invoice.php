<?php

    if(isset($_POST['customer_id']) && isset($_POST['product_id']) && isset($_POST['available_quantity']) && isset($_POST['product_quantity']) && isset($_POST['product_rate']) && isset($_POST['total_price']) && isset($_POST['invoice_date']) && isset($_POST['total_discount']) && isset($_POST['grand_total']) && isset($_POST['paid_amount']) && isset($_POST['due_amount'])){
        $customer_id = trim(htmlentities(addslashes($_POST['customer_id'])));
        $invoice_date = trim(htmlentities(addslashes($_POST['invoice_date'])));
        $total_discount = trim(htmlentities(addslashes($_POST['total_discount'])));
        $grand_total = trim(htmlentities(addslashes($_POST['grand_total'])));
        $paid_amount = trim(htmlentities(addslashes($_POST['paid_amount'])));
        $due_amount = trim(htmlentities(addslashes($_POST['due_amount'])));

        if(!empty($customer_id) || !empty($invoice_date) || !empty($grand_total)){
            $productCount = count($_POST['product_id']);

            

        }else{
            echo "<h5 class='text-danger'>Attention, All field are required..!</h5>";
        }
    }else{
        echo "<h5 class='text-danger'>Oops, Sorry Something Wrong..!</h5>";
    }

?>
<?php 

    if(!isset($current_user_id)){die('Unauthorized Error');}

    //summation of loan amount from loan
    $getSumLoanQry = "SELECT SUM(amount) AS sumLoan FROM `loan` WHERE `type` = 'Loan'";
    $getSumLoan = mysqli_query($conn, $getSumLoanQry);
    $getSumLoan = mysqli_fetch_assoc($getSumLoan);
    $getSumLoan = $getSumLoan['sumLoan'];

    //summation of Invest amount from Invest
    $getSumInvestQry = "SELECT SUM(amount) AS sumInvest FROM `loan` WHERE `type` = 'Invest'";
    $getSumInvest = mysqli_query($conn, $getSumInvestQry);
    $getSumInvest = mysqli_fetch_assoc($getSumInvest);
    $getSumInvest = $getSumInvest['sumInvest'];

    //summation of Profit Withdrawal cost amount
    $loanPay = mysqli_query($conn, "SELECT SUM(amount) AS loanPay FROM `cost` WHERE cost_type='Loan Pay'");
    $loanPay = mysqli_fetch_assoc($loanPay);
    $loanPay = $loanPay['loanPay'];

    $currentLoan = $getSumLoan - $loanPay;

    //last month income from loan
    $getLastMonthLoan = mysqli_query($conn, "SELECT SUM(amount) AS lastMonthLoan FROM `loan` WHERE date > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthLoan = mysqli_fetch_assoc($getLastMonthLoan);
    $getLastMonthLoan = $getLastMonthLoan['lastMonthLoan'];
    

    //summation of pay amount from invoices
    $getSumPayQry = "SELECT SUM(pay) AS sumPay FROM `invoices`";
    $getSumPay = mysqli_query($conn, $getSumPayQry);
    $getSumPay = mysqli_fetch_assoc($getSumPay);
    $getSumPay = $getSumPay['sumPay'];

    $getLastMonthPay = mysqli_query($conn, "SELECT SUM(pay) AS lastMonthPay FROM `invoices` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthPay = mysqli_fetch_assoc($getLastMonthPay);
    $getLastMonthPay = $getLastMonthPay['lastMonthPay'];
    

    //summation of product supplier price amount
    $totalProductSuppPrice = mysqli_query($conn, "SELECT SUM(supplier_price * primary_quantity) AS sumSuppPrice FROM `products`");
    $totalProductSuppPrice = mysqli_fetch_assoc($totalProductSuppPrice);
    $totalProductSuppPrice = $totalProductSuppPrice['sumSuppPrice'];

    //last month product supplier price amount
    $lastMonthSuppPrice = mysqli_query($conn, "SELECT SUM(supplier_price * primary_quantity) AS lastMonthSuppPrice FROM `products` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $lastMonthSuppPrice = mysqli_fetch_assoc($lastMonthSuppPrice);
    $lastMonthSuppPrice = $lastMonthSuppPrice['lastMonthSuppPrice'];

    
    //summation of others cost amount
    $getSumCost = mysqli_query($conn, "SELECT SUM(amount) AS sumCost FROM `cost` WHERE cost_type='others'");
    $getSumCost = mysqli_fetch_assoc($getSumCost);
    $getSumCost = $getSumCost['sumCost'];
    
    //last month others cost amount
    $getLastMonthCost = mysqli_query($conn, "SELECT SUM(amount) AS lastMonthCost FROM `cost` WHERE cost_type='others' && cost_date > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthCost = mysqli_fetch_assoc($getLastMonthCost);
    $getLastMonthCost = $getLastMonthCost['lastMonthCost'];

    $totalExpenses = $totalProductSuppPrice + $getSumCost;
    $lastMonthExpenses = $lastMonthSuppPrice + $getLastMonthCost;

    //summation of Profit Withdrawal cost amount
    $getSumWidrw = mysqli_query($conn, "SELECT SUM(amount) AS sumWidrw FROM `cost` WHERE cost_type='Profit Withdrawal'");
    $getSumWidrw = mysqli_fetch_assoc($getSumWidrw);
    $getSumWidrw = $getSumWidrw['sumWidrw'];
    
    //last month Profit Withdrawal cost amount
    $getLastMonthWidrw = mysqli_query($conn, "SELECT SUM(amount) AS lastMonthWidrw FROM `cost` WHERE cost_type='Profit Withdrawal' && cost_date > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthWidrw = mysqli_fetch_assoc($getLastMonthWidrw);
    $getLastMonthWidrw = $getLastMonthWidrw['lastMonthWidrw'];

    //summation of others cost amount
    $totalCost = mysqli_query($conn, "SELECT SUM(amount) AS totalCost FROM `cost`");
    $totalCost = mysqli_fetch_assoc($totalCost);
    $totalCost = $totalCost['totalCost'];

    $currentCash = ($getSumLoan + $getSumPay + $getSumInvest) - ($totalProductSuppPrice + $totalCost);

    
    //summation of pay amount from invoices
    $getSumProfitQry = "SELECT SUM(total_supplier_price) AS sumSuppPrice FROM `invoices` where pay != 0";
    $getSumSuppPrice = mysqli_query($conn, $getSumProfitQry);
    $getSumSuppPrice = mysqli_fetch_assoc($getSumSuppPrice);
    $getSumSuppPrice = $getSumSuppPrice['sumSuppPrice'];

    // Total of Transport Cost from cost table
    $transportCost = mysqli_query($conn, "SELECT SUM(amount) AS transportCost FROM `cost` WHERE cost_type='Transport Cost'");
    $transportCost = mysqli_fetch_assoc($transportCost);
    $transportCost = $transportCost['transportCost'];

    // Total of Transport Cost from cost table
    $lastMntTransportCost = mysqli_query($conn, "SELECT SUM(amount) AS transportCost FROM `cost` WHERE cost_type='Transport Cost' && cost_date > (NOW() - INTERVAL 1 MONTH)");
    $lastMntTransportCost = mysqli_fetch_assoc($lastMntTransportCost);
    $lastMntTransportCost = $lastMntTransportCost['transportCost'];

    $main_profit = $getSumPay - $getSumSuppPrice - $getSumWidrw - $transportCost;

    $getLastMonthSuppPrice = mysqli_query($conn, "SELECT SUM(total_supplier_price) AS sumSuppPrice FROM `invoices` WHERE pay != 0 AND created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthSuppPrice = mysqli_fetch_assoc($getLastMonthSuppPrice);
    $getLastMonthSuppPrice = $getLastMonthSuppPrice['sumSuppPrice'];

    $LastMonthMainProfit = $getLastMonthPay - $getLastMonthSuppPrice - $getLastMonthWidrw - $lastMntTransportCost;
    

    //summation of product stock
    $productStockQty = mysqli_query($conn, "SELECT SUM(quantity) AS productStockQty FROM `products`");
    $productStockQty = mysqli_fetch_assoc($productStockQty);
    $productStockQty = $productStockQty['productStockQty'];

    //summation of product stock
    $productStockQtyPrice = mysqli_query($conn, "SELECT SUM(quantity * supplier_price) AS productStockQtyPrice FROM `products`");
    $productStockQtyPrice = mysqli_fetch_assoc($productStockQtyPrice);
    $productStockQtyPrice = $productStockQtyPrice['productStockQtyPrice'];


    // due invoices amount
    $getSumDueInvQry = "SELECT SUM(due) AS sumDue FROM `invoices` WHERE due > 0";
    $getSumDueInv = mysqli_query($conn, $getSumDueInvQry);
    $getSumDueInvCount = mysqli_num_rows($getSumDueInv);
    $getSumDueInv = mysqli_fetch_assoc($getSumDueInv);
    $getSumDueInv = $getSumDueInv['sumDue'];

    $getLastMonthDueInv = mysqli_query($conn, "SELECT SUM(due) AS lastMonthDue FROM `invoices` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthDueInvCount = mysqli_num_rows($getLastMonthDueInv);
    $getLastMonthDueInv = mysqli_fetch_assoc($getLastMonthDueInv);
    $getLastMonthDueInv = $getLastMonthDueInv['lastMonthPay'];
?>


<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Invest</h6>
                <h2 class="text-right"><i class="bx bx-briefcase f-left"></i><span><?php echo $getSumInvest ? $getSumInvest : '0'; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthLoan ? $getLastMonthLoan : '0'; ?></span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Loan</h6>
                <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span><?php echo $currentLoan ? $currentLoan : '0'; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthLoan ? $getLastMonthLoan : '0'; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-yellow order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Income</h6>
                <h2 class="text-right"><i class="ti-reload f-left"></i><span><?php echo $getSumPay ? $getSumPay : '0'; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthPay ? $getLastMonthPay : '0'; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Expense</h6>
                <h2 class="text-right"><i class="ti-tag f-left"></i><span><?php echo $totalExpenses ? $totalExpenses: '0'; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php  echo $lastMonthExpenses ? $lastMonthExpenses : '0'; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6 class="m-b-20">Cash</h6>
                <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?php echo $currentCash ? $currentCash : '0'; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthLoan - $lastMonthExpenses ? $getLastMonthLoan - $lastMonthExpenses : '0'; ?></span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Profit</h6>
                <h2 class="text-right"><i class="bx bxl-product-hunt f-left"></i><span><?php echo $main_profit; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $LastMonthMainProfit; ?></span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
<<<<<<< HEAD
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Due Invoice</h6>
                <h2 class="text-right"><i class="bx bxl-product-hunt f-left"></i><span><?php echo $getSumDueInvCount; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthDueInvCount; ?></span></p>
=======
        <div class="card bg-warning order-card">
            <div class="card-block">
                <h6 class="m-b-20">Product Stock</h6>
                <h2 class="text-right"><i class="bx bx-cart-download f-left"></i><span><?php echo $productStockQty; ?></span></h2>
                <p class="m-b-0">&nbsp;</p>
>>>>>>> e96df90ee5c759c71990b9ac2d0a9ccdae2a8a22
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
<<<<<<< HEAD
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Due Invoice Amount</h6>
                <h2 class="text-right"><i class="bx bxl-product-hunt f-left"></i><span><?php echo $getSumDueInv; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthDueInv; ?></span></p>
=======
        <div class="card bg-info order-card">
            <div class="card-block">
                <h6 class="m-b-20">Product Stock Price</h6>
                <h2 class="text-right"><i class="bx bxl-shopify f-left"></i><span><?php echo $productStockQtyPrice; ?></span></h2>
                <p class="m-b-0">&nbsp;</p>
>>>>>>> e96df90ee5c759c71990b9ac2d0a9ccdae2a8a22
            </div>
        </div>
    </div>
    <!-- order-card end -->

    
</div>
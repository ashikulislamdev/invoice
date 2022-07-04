<?php 

    if(!isset($current_user_id)){die('Unauthorized Error');}

    //summation of loan amount from loan
    $getSumLoanQry = "SELECT SUM(amount) AS sumLoan FROM `loan`";
    $getSumLoan = mysqli_query($conn, $getSumLoanQry);
    $getSumLoan = mysqli_fetch_assoc($getSumLoan);
    $getSumLoan = $getSumLoan['sumLoan'];

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
    

    //summation of cost amount
    $getSumCost = mysqli_query($conn, "SELECT SUM(amount) AS sumCost FROM `cost` WHERE cost_type='others'");
    $getSumCost = mysqli_fetch_assoc($getSumCost);
    $getSumCost = $getSumCost['sumCost'];
    
    //last month cost amount
    $getLastMonthCost = mysqli_query($conn, "SELECT SUM(amount) AS lastMonthCost FROM `cost` WHERE cost_type='others' && date > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthCost = mysqli_fetch_assoc($getLastMonthCost);
    $getLastMonthCost = $getLastMonthCost['lastMonthCost'];

    //summation of Product cost amount
    $cash = $getSumPay - $getSumCost;
    $lastMonthCash = $getLastMonthPay - $getLastMonthCost;

    
    //summation of pay amount from invoices
    $getSumProfitQry = "SELECT SUM(total_supplier_price) AS sumSuppPrice FROM `invoices`";
    $getSumSuppPrice = mysqli_query($conn, $getSumProfitQry);
    $getSumSuppPrice = mysqli_fetch_assoc($getSumSuppPrice);
    $getSumSuppPrice = $getSumSuppPrice['sumSuppPrice'];

    $main_profit = $getSumPay - $getSumSuppPrice;

    $getLastMonthSuppPrice = mysqli_query($conn, "SELECT SUM(total_supplier_price) AS sumSuppPrice FROM `invoices` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthSuppPrice = mysqli_fetch_assoc($getLastMonthSuppPrice);
    $getLastMonthSuppPrice = $getLastMonthSuppPrice['sumSuppPrice'];

    $LastMonthMainProfit = $getLastMonthPay - $getLastMonthSuppPrice;
    
?>

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Loan</h6>
                <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span><?php echo $getSumLoan ? $getSumLoan : '0'; ?></span></h2>
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
                <h2 class="text-right"><i class="ti-tag f-left"></i><span><?php echo $getSumCost ? $getSumCost : '0'; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php  echo $getLastMonthCost ? $getLastMonthCost : '0'; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6 class="m-b-20">Cash</h6>
                <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?php echo $cash; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $lastMonthCash ? $lastMonthCash : '0'; ?></span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Profit</h6>
                <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?php echo $main_profit; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $LastMonthMainProfit; ?></span></p>
            </div>
        </div>
    </div>
    <!-- order-card end -->

    
</div>
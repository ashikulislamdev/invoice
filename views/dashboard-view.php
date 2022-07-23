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
    $getSumProfitQry = "SELECT SUM(total_supplier_price) AS sumSuppPrice FROM `invoices`";
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

    $getLastMonthSuppPrice = mysqli_query($conn, "SELECT SUM(total_supplier_price) AS sumSuppPrice FROM `invoices` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthSuppPrice = mysqli_fetch_assoc($getLastMonthSuppPrice);
    $getLastMonthSuppPrice = $getLastMonthSuppPrice['sumSuppPrice'];

    $LastMonthMainProfit = $getLastMonthPay - $getLastMonthSuppPrice - $getLastMonthWidrw - $lastMntTransportCost;
    
?>

<h1 class="mt-5 py-5 text-center bg-danger text-white">Hello, Rashed Vaiya. How are you..?</h1>

<div class="row d-none">
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
    <!-- order-card end -->

    
</div>
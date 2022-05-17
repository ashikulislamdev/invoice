<?php 

    if(!isset($current_user_id)){die('Unauthorized Error');}

    //summation of loan amount from loan
    $getSumLoanQry = "SELECT SUM(amount) AS sumLoan FROM `loan`";
    $getSumLoan = mysqli_query($conn, $getSumLoanQry);
    $getSumLoan = mysqli_fetch_assoc($getSumLoan);
    $getSumLoan = $getSumLoan['sumLoan'];
    
    //summation of pay amount from invoices
    $getSumPayQry = "SELECT SUM(pay) AS sumPay FROM `invoices`";
    $getSumPay = mysqli_query($conn, $getSumPayQry);
    $getSumPay = mysqli_fetch_assoc($getSumPay);
    $getSumPay = $getSumPay['sumPay'];

    //total income
    $all_incomes = $getSumLoan + $getSumPay;

    //last month income from loan
    $getLastMonthLoan = mysqli_query($conn, "SELECT SUM(amount) AS lastMonthLoan FROM `loan` WHERE date > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthLoan = mysqli_fetch_assoc($getLastMonthLoan);
    $getLastMonthLoan = $getLastMonthLoan['lastMonthLoan'];

    $getLastMonthPay = mysqli_query($conn, "SELECT SUM(pay) AS lastMonthPay FROM `invoices` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthPay = mysqli_fetch_assoc($getLastMonthPay);
    $getLastMonthPay = $getLastMonthPay['lastMonthPay'];
    
    $totalLastMonthIncome = $getLastMonthLoan + $getLastMonthPay;



    //summation of cost amount
    $getSumCost = mysqli_query($conn, "SELECT SUM(amount) AS sumCost FROM `cost`");
    $getSumCost = mysqli_fetch_assoc($getSumCost);
    $getSumCost = $getSumCost['sumCost'];
    
    //summation of Product cost amount
    $getProductCost = mysqli_query($conn, "SELECT SUM(supplier_price * quantity) AS sumProductCost FROM `products`");
    $getProductCost = mysqli_fetch_assoc($getProductCost);
    $getProductCost = $getProductCost['sumProductCost'];

    $all_expense = $getSumCost + $getProductCost;
    
    //last month cost amount
    $getLastMonthCost = mysqli_query($conn, "SELECT SUM(amount) AS lastMonthCost FROM `cost` WHERE date > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthCost = mysqli_fetch_assoc($getLastMonthCost);
    $getLastMonthCost = $getLastMonthCost['lastMonthCost'];

    //last month product cost amount
    $getLastMonthProductCost = mysqli_query($conn, "SELECT SUM(supplier_price * quantity) AS lastMonthProductCost FROM `products` WHERE created > (NOW() - INTERVAL 1 MONTH)");
    $getLastMonthProductCost = mysqli_fetch_assoc($getLastMonthProductCost);
    $getLastMonthProductCost = $getLastMonthProductCost['lastMonthProductCost'];

    $lastMonthExpense = $getLastMonthCost + $getLastMonthProductCost;


    $cash = ($getSumLoan - $all_expense) + $getSumPay;
    $lastMonthCash = ($getLastMonthLoan - $lastMonthExpense) + $getLastMonthPay;
    
?>

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Invest</h6>
                <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span><?php echo $getSumLoan; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthLoan; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-yellow order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Income</h6>
                <h2 class="text-right"><i class="ti-reload f-left"></i><span><?php echo $getSumPay; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $getLastMonthPay; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h6 class="m-b-20">Total Expense</h6>
                <h2 class="text-right"><i class="ti-tag f-left"></i><span><?php echo $all_expense; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php  echo $lastMonthExpense; ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6 class="m-b-20">Cash</h6>
                <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?php echo $cash; ?></span></h2>
                <p class="m-b-0">This Month<span class="f-right"><?php echo $totalLastMonthIncome - $getLastMonthCost; ?></span></p>
            </div>
        </div>
    </div>
    <!-- order-card end -->

    
</div>
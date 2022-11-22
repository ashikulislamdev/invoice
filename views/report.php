<?php 
    include('api/customers.php');
?>


<div class="pb-2 text-center" id="message_section"></div>

<div class="container">
    
    <?php
        if(isset($_POST['customer_id'])){

            $customer_id = htmlentities(addslashes($_POST['customer_id']));

            $customerSql = "SELECT * FROM `customers` WHERE `id` = '$customer_id'";
            $runCustomerSql = mysqli_query($conn, $customerSql);
            if($runCustomerSql && mysqli_num_rows($runCustomerSql) == 1){
                $customerInfo = mysqli_fetch_assoc($runCustomerSql);
            }

            $instituteSql = "SELECT * FROM `instituteinfo` WHERE `id` = '1'";
            $runInstituteSql = mysqli_query($conn, $instituteSql);
            if($runInstituteSql && mysqli_num_rows($runInstituteSql) == 1){
                $instituteinfo = mysqli_fetch_assoc($runInstituteSql);
            }
    ?>
    <div class="row">
        <div class="col-md-12 mx-auto">
            <a class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" href="report.php"> Search Again </a>
            <div class="card" style="border-radius: 0px;">
                <h4 class="bg-primary p-3">Invoice Report History</h4>

                <div id="printSection">
                    <div class="col-12 mx-auto" style="width: 800px;">
                        <div class="card p-0" style="border-radius: 0px;">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-8">
                                        <?php
                                            if(isset($instituteinfo)){
                                        ?>
                                        <img src="images/<?php echo $instituteinfo['instituteLogo'] ?>" style="height: 80px;">
                                        <h5><?php echo $instituteinfo['instituteName']; ?>,</h5>
                                        <p class="m-0"><?php echo $instituteinfo['instituteAddress'] ?></p>
                                        <p><?php echo $instituteinfo['institutePhone'] ?>, <a class="text-primary" href="http://satkaniacec.com/" target="_blank"><span class="underline">www.satkaniacec.com</span></a></p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-4">
                                        <?php
                                            if(isset($customerInfo)){
                                        ?>
                                        <h5 class="pb-2">Invoice To:</h5>
                                                                            
                                        <p class="m-0"><?php echo $customerInfo['customer_name']; ?>,</p>
                                        <p class="m-0"><?php echo $customerInfo['address']; ?></p>
                                        <p class="m-0">Phone: <?php echo $customerInfo['customer_phone']; ?></p>
                                        <?php } ?>

                                    </div>

                                </div>
                                <?php 
                                    if(isset($_POST['from_date']) && isset($_POST['to_date'])){
                                        ?>
                                            <p class="text-center">
                                                Invoice Statement For The Period: <span class='font-weight-bold'><?php echo $_POST['from_date'] . " to " . $_POST['to_date'];  ?></span>
                                            </p>
                                        <?php
                                    }
                                ?>
                                <div class="px-2 table-responsive">
                                    <table class="table table-striped table-hover text-center" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Invoice No</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Pay</th>
                                                <th class="text-center">Due</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                
                                                $inv_sql = "SELECT * FROM `invoices` WHERE `customer_id` = '$customer_id'";
                                                if($_POST['from_date'] != '' && $_POST['to_date'] != ''){
                                                    $from_date = date('Y-m-d', strtotime($_POST['from_date']));
                                                    $to_date = date('Y-m-d', strtotime($_POST['to_date']));
                                                    $inv_sql .= " AND `created` BETWEEN '$from_date' AND '$to_date'";
                                                }
                                                $inv_sql .= " ORDER BY `id` DESC";
                                                $inv_result = mysqli_query($conn, $inv_sql);
                                                if(mysqli_num_rows($inv_result) > 0){
                                                    $total_pay = 0;
                                                    $total_due = 0;
                                                    $total_amount = 0;
                                                    while($inv_row = mysqli_fetch_assoc($inv_result)){
                                                        $total_amount += $inv_row['total'];
                                                        $total_pay += $inv_row['pay'];
                                                        $total_due += $inv_row['due'];
                                            ?>
                                            
                                            <tr>
                                                <td>
                                                    <?php
                                                        echo "#" . $inv_row['id'];

                                                        if($inv_row['due'] > 0){
                                                            echo "<span style='display: none;'> due</span>";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('d M Y', strtotime($inv_row['created'])) ?></td>
                                                <td><?php echo $inv_row['total']; ?> TK</td>
                                                <td><?php echo $inv_row['pay']; ?> TK</td>
                                                <td><?php echo $inv_row['due']; ?> TK</td>
                                            </tr>
                                            <?php
                                                    }
                                                }else{
                                                    echo "<tr><td colspan='5'><b>No Data Found!</b></td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-2">
                                    <?php
                                        if(isset($total_pay) && isset($total_due) && isset($total_amount)){
                                            // echo "<h6 class='text-right mb-1'>Total Pay: <b>$total_pay</b> TK</h6>";
                                            echo "<p class='text-right mb-1'>Total Due Amount: <b>$total_due</b> TK</p>";
                                            // echo "<h6 class='text-right mb-1'>Total Amount: <b>$total_amount</b> TK</h6>";
                                        }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            
                                            <br><br><br>
                                            <h6><span class="px-2" style="border-top: 1px solid black;">Satkania CEC</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-3 text-center">
                                        <p>Invoice created by: Admin</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center pb-3">
                    <button onclick="printSection()" class="btn btn-info btn-lg py-2" style="width: 150px;"><span class="btn-label"><i class="ti-printer"></i></span> Print Now</button>
                </div>

            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="card mx-auto" style="width: 600px; max-width: 100%;">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="m-0">Customer Report</h4>
        </div>
        <div class="card-body pt-4 pb-2">
            <form action="" method="post">
                <div class="panel-body">
                    <div class="row">
                        <div id="error"></div>     
                        
                        <div class="col-sm-12" id="customer_section_1">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select class="form-control select2" name="customer_id" id="customer_id" onchange="Customer(this.value)" required>
                                        <option selected disabled>-- Select Customer --</option>
                                        <?php
                                            if(isset($customersData)){
                                                foreach ($customersData as $key => $value) {
                                                    echo "<option value='".$value['id']."'>".$value['customer_name']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" autocomplete="off" name="customer_phone" id="InvCustomerPhone" class=" form-control" placeholder="Customer Phone No" readonly>
                                </div>
                                <div class="col-md-12 pt-2">
                                    <input type="text" name="customer_address" autocomplete="off" class=" form-control" placeholder="Customer Address" id="InvCustomerAddress" readonly>
                                </div>
                                <div class="col-md-6 pt-2">
                                    <input type="date" name="from_date" class=" form-control" placeholder="From Date">
                                </div>
                                <div class="col-md-6 pt-2">
                                    <input type="date" name="to_date" class=" form-control" placeholder="To Date">
                                </div>

                                <div class="col-md-12 pt-3">
                                    <button class="btn btn-primary" type="submit">Search Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>

</div>

<script>
	function printSection() {
		var divContents = document.getElementById("printSection").innerHTML;
		var a = window.open('', '', 'height=1000px, width=1000px');
		a.document.write('<html><head>');
		a.document.write("<meta name='author' content='codedthemes'><link rel='icon' href='assets/images/favicon.ico' type='image/x-icon'><link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet'><link rel='stylesheet' type='text/css' href='assets/css/bootstrap/css/bootstrap.min.css'><link rel='stylesheet' type='text/css' href='assets/icon/themify-icons/themify-icons.css'><link rel='stylesheet' type='text/css' href='assets/icon/font-awesome/css/font-awesome.min.css'><link rel='stylesheet' type='text/css' href='assets/icon/icofont/css/icofont.css'><link rel='stylesheet' type='text/css' href='assets/css/style.css'><link rel='stylesheet' type='text/css' href='assets/css/jquery.mCustomScrollbar.css'>");
		a.document.write("<style>.pcoded-main-container{background: white;} body{background-color: white;}</style>");
		a.document.write('</head><body>');
		a.document.write(divContents);
		a.document.write('</body></html>');
		a.document.close();
		a.print();
	}
</script>
<?php

    if(isset($_GET['supplier_id']) && isset($_GET['action'])){
        $supplier_id = htmlentities(addslashes($_GET['supplier_id']));
        $action = htmlentities(addslashes($_GET['action']));
    }
    $buy = false;
    $pay = false;
    $details = false;
    $buy_edit = false;
    $pay_edit = false;
    $balance = 0;

    // Include Supplier Info API
    include 'api/supplier-info.php';
    
    if(isset($supplierInfo)){
        if($action == 'buy'){
            $buy = true;

            if(isset($_GET['id'])){

                // Include Supplier Buy Edit API
                include 'api/supplier-account-info.php';

                if(isset($supplierAccountInfo)){
                    $buy_edit = true;
                }
            }

        }else if($action == 'pay'){
            $pay = true;

            if(isset($_GET['id'])){

                // Include Supplier Buy Edit API
                include 'api/supplier-account-info.php';

                if(isset($supplierAccountInfo)){
                    $pay_edit = true;
                }
            }
        }else if($action == 'details'){
            // Include Supplier Info API
            include 'api/supplier-account.php';

            if (isset($supplierAccountCount)) {
                $details = true;
            }
        }
    }

?>

<?php if($buy || $pay || $details){ ?>
<div class="row">

    <!-- Message -->
    <div class="col-md-12">
        <?php
            if(isset($_GET['response'])){
                $response = htmlentities(addslashes($_GET['response']));
                if($response == 'null'){
                    echo '<div class="alert alert-danger">Please fill all the fields.</div>';
                }else if($response == 'record_added'){
                    echo '<div class="alert alert-success">Record Added Successfully.</div>';
                }else if($response == 'record_updated'){
                    echo '<div class="alert alert-success">Record Updated Successfully.</div>';
                }else if($response == 'record_deleted'){
                    echo '<div class="alert alert-success">Record Deleted Successfully.</div>';
                }else if($response == 'something_wrong'){
                    echo '<div class="alert alert-danger">Oops, Something Wrong..!</div>';
                }
            }
        ?>
    </div>

    <!-- supplier information -->
    <div class="col-md-4">
        <div class="card mb-2" style="border-radius: 0px !important;">
            <div class="card-header bg-primary p-2" style="border-radius: 0px !important;">
                <h5 class="text-white m-0">Supplier Information</h5>
            </div>
            <div class="card-body px-2 py-3" style="background: aliceblue;">
                <p class="mb-1">Name: <b><?php echo $supplierInfo['supplier_name']; ?></b></p>
                <p class="mb-1">Phone: <b><?php echo $supplierInfo['supplier_phone']; ?></b></p>
                <p class="mb-1">Shop Name: <b><?php echo $supplierInfo['shop_name']; ?></b></p>
                <p class="mb-1">Address: <b><?php echo $supplierInfo['address']; ?></b></p>
            </div>
            <div style="display:grid; grid-template-columns: 50% 50%;">
                <?php if($buy == false){ ?>
                    <a href="supplier-account.php?supplier_id=<?php echo $supplierInfo['id']; ?>&action=buy" class="btn btn-primary btn-sm w-100" style="border-radius: 0px;">Buy</a>
                <?php } ?>
                <?php if($pay == false){ ?>
                    <a href="supplier-account.php?supplier_id=<?php echo $supplierInfo['id']; ?>&action=pay" class="btn btn-warning btn-sm w-100" style="border-radius: 0px;">Pay</a>
                <?php } ?>
                <?php if($details == false){ ?>
                    <a href="supplier-account.php?supplier_id=<?php echo $supplierInfo['id']; ?>&action=details" class="btn btn-danger btn-sm w-100" style="border-radius: 0px;">Details</a>
                <?php } ?>
            </div>
        </div>
        
    </div>

    <!-- buy form -->
    <?php if($buy){ ?>
	<div class="col-md-8 mx-auto">
		<div class="card" style="border-radius: 0px;">
            <div class="card-header bg-primary p-2" style="border-radius: 0px !important;">
                <h5 class="text-white m-0">Buy > <?php if($buy_edit){echo 'Edit';}else{echo 'Create';} ?></h5>
            </div>

            <div class="card-body">
                <form method="post" action="<?php if($buy_edit){echo 'core/supplier-buy-edit.php';}else{echo 'core/supplier-buy.php';} ?>">

                    <?php if($buy_edit){ ?>
                    <input type="hidden" name="id" value="<?php echo $supplierAccountInfo['id']; ?>" readonly>
                    <?php }?>
                    <input type="hidden" name="supplier_id" value="<?php echo $supplierInfo['id']; ?>" readonly>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="buy_amount" class="col-form-label">Amount:</label>
                                    <input type="number" class="form-control" name="buy_amount" placeholder="Amount" value="<?php if($buy_edit){echo $supplierAccountInfo['buy_amount']; }; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="voucher_no" class="col-form-label">Voucher No:</label>
                                    <input type="text" class="form-control" name="voucher_no" value="<?php if($buy_edit){echo $supplierAccountInfo['voucher_no']; }; ?>" placeholder="Voucher No" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="col-form-label">Date:</label>
                                    <input type="date" class="form-control" name="date" value="<?php if($buy_edit){echo $supplierAccountInfo['date']; }else{echo date("Y-m-d");} ?>" placeholder="yyyy-mm-dd" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="details" class="col-form-label">Details:</label>
                                    <textarea name="details" class="form-control" placeholder="write details here..." name="details" style="min-height: 80px;"><?php if($buy_edit){echo $supplierAccountInfo['details']; }; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
    <?php } ?>

    <!-- pay form -->
    <?php if($pay){ ?>
	<div class="col-md-8 mx-auto">
		<div class="card" style="border-radius: 0px;">
            <div class="card-header bg-primary p-2" style="border-radius: 0px !important;">
                <h5 class="text-white m-0">Pay > <?php if ($pay_edit) {
                    echo 'Edit';
                } else {
                    echo 'Create';
                } ?></h5>
            </div>

            <div class="card-body">
                <form method="post" action="<?php if ($pay_edit) {
                    echo 'core/supplier-pay-edit.php';
                } else {
                    echo 'core/supplier-pay.php';
                } ?>">

                    <?php if($pay_edit){ ?>
                    <input type="hidden" name="id" value="<?php echo $supplierAccountInfo['id']; ?>" readonly>
                    <?php }?>
                    <input type="hidden" name="supplier_id" value="<?php echo $supplierInfo['id']; ?>" readonly>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pay_amount" class="col-form-label">Amount:</label>
                                    <input type="number" class="form-control" name="pay_amount" placeholder="Amount"value="<?php if($pay_edit){echo $supplierAccountInfo['pay_amount']; }; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="col-form-label">Date:</label>
                                    <input type="date" class="form-control" name="date" value="<?php if($pay_edit){echo $supplierAccountInfo['date']; }else{echo date("Y-m-d");} ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details" class="col-form-label">Details:</label>
                                    <textarea name="details" class="form-control" placeholder="write details here..." name="details" style="min-height: 80px;"><?php if($pay_edit){echo $supplierAccountInfo['details']; }; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
    <?php } ?>

    <!-- details -->
    <?php if($details){ ?>
    <div class="col-md-8 mx-auto">
        <div class="table-responsive" id="printSection">
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center">Date</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Buy</th>
                        <th class="text-center">Pay</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($supplierAccountData) && (count($supplierAccountData) > 0)) {
                            foreach ($supplierAccountData as $key => $record) {
                    ?>  
                    <tr>
                        <td><?php echo $record['date']; ?></td>
                        <td><?php echo $record['details']; if(!empty($record['details']) && !empty($record['voucher_no'])){ echo ' - '; } echo $record['voucher_no'] ?></td>
                        <td><?php echo $record['buy_amount']; ?></td>
                        <td><?php echo $record['pay_amount']; ?></td>
                        <td>
                            <?php
                                $balance += $record['buy_amount'];
                                if ($record['pay_amount'] > 0) $balance -= $record['pay_amount'];
                                echo $balance;
                            ?>
                        </td>
                        <td>
                            <a href="supplier-account.php?supplier_id=<?php echo $record['supplier_id'] ?>&action=<?php if ($record['buy_amount'] > 0){echo 'buy';}else{echo 'pay';} ?>&id=<?php echo $record['id']; ?>"><span class="badge bg-primary">Edit</span></a>
                            <a href="#"
                            onclick="
                            if(confirm('Are you sure to delete this record?')){
                                window.location.href = 'core/supplier-account-delete.php?id=<?php echo $record['id']; ?>&supplier_id=<?php echo $record['supplier_id']; ?>';
                            }"
                            ><span class="badge bg-danger">Delete</span></a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                    <tr>
                        <td colspan="6" class="text-center text-danger"><b>No Record Found..!</b></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <button class="btn btn-primary" onclick="printSection()">Print Now</button>
        </div>
    </div>
    <?php } ?>

</div>
<?php } ?>


<script>
	function printSection() {
		var divContents = document.getElementById("printSection").innerHTML;
		var a = window.open('', '', 'height=1000px, width=1000px');
		a.document.write('<html><head>');
		a.document.write("<link rel='stylesheet' type='text/css' href='assets/css/bootstrap/css/bootstrap.min.css'><link rel='stylesheet' type='text/css' href='assets/css/style.css'>");
		a.document.write("<style>th{color: black;}</style>");
		a.document.write('</head><body>');
		a.document.write(divContents);
		a.document.write('</body></html>');
		a.document.close();
		a.print();
	}
</script>
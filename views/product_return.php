<?php

    // Include Supplier API
    include 'api/suppliers.php';
    // Import Product API
    include 'api/products.php';

    if(isset($_GET['invoice_id'])){
        $invoice_id = trim(htmlentities(addslashes($_GET['invoice_id'])));

        $sql = "SELECT * FROM `invoices` WHERE `id` = '$invoice_id'";
        $runSql = mysqli_query($conn, $sql);
        if($runSql && mysqli_num_rows($runSql) == 1){
            $invoiceInfo = mysqli_fetch_assoc($runSql);

            $customer_id = $invoiceInfo['customer_id'];

            $customerSql = "SELECT * FROM `customers` WHERE `id` = '$customer_id'";
            $runCustomerSql = mysqli_query($conn, $customerSql);
            if($runCustomerSql && mysqli_num_rows($runCustomerSql) == 1){
                $customerInfo = mysqli_fetch_assoc($runCustomerSql);
            }

            $invoiceItemSql = "SELECT * FROM `invoice_item` WHERE `invoice_id` = '$invoice_id'";
            $runInvoiceItemSql = mysqli_query($conn, $invoiceItemSql);
            if($runInvoiceItemSql && mysqli_num_rows($runInvoiceItemSql) > 0){
                while($invItemRow = mysqli_fetch_assoc($runInvoiceItemSql)){
                    $invoiceItemInfo[] = $invItemRow;
                }
            }
        }

        // check invoice exist or not
        if(!isset($invoiceInfo)) echo '<script>alert("Invoice Not Found.", "warning");window.location.href = "invoice.php";</script>';

        $instituteSql = "SELECT * FROM `instituteinfo` WHERE `id` = '1'";
        $runInstituteSql = mysqli_query($conn, $instituteSql);
        if($runInstituteSql && mysqli_num_rows($runInstituteSql) == 1){
            $instituteinfo = mysqli_fetch_assoc($runInstituteSql);
        }

    }else{
        die("Oops, Sorry Something Wrong..!");
    }
?>

<?php if(isset($invoiceInfo)){ ?>
<div id="printSection" style="overflow: auto;">
    <div class="col-12 mx-auto pt-2" style="min-width: 1000px;">
        <div class="card p-0" style="border-radius: 0px;">
            <div class="card-header p-2 px-3" style="background-color: #c7c7c7; border-radius: 0px;">
                <h5 class="float-left mb-0">Invoice <?php echo "#" . $invoiceInfo['id']; ?></h5>
                <div class="float-right"><?php echo date('M d, Y', strtotime($invoiceInfo['created'])) ?></div>
            </div>
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
                
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">SL NO</th>
                            <th class="text-center" style="max-width: 100px;">Product</th>
                            <th class="text-center" style="width: 100px;">Quantity</th>
                            <th class="text-center">Rate</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($invoiceItemInfo)) {
                                foreach ($invoiceItemInfo as $key => $value) {
                                    ?>
                        <tr>
                            <td><?php echo ++$key; ?></td>
                            <td class="text-left" style="white-space: revert;">
                                <?php
                                    $product_id = $value['product_id'];
									if(isset($productsData)){
										foreach ($productsData as $productInfo) {
											if($product_id == $productInfo['id']){
                                                $voucher_no = $productInfo['voucher_no'];
                                                $shop_name = '';
                                                $supplier_view_id = $productInfo['supplier_id'];
                                                if(isset($suppliersData)){
                                                    foreach ($suppliersData as $supplierView) {
                                                        if($supplier_view_id == $supplierView['id'] ){
                                                            $shop_name = $supplierView['shop_name'];
                                                        }
                                                    }
                                                }
                                                echo '<p class="mb-0" title="Shop Name: '.$shop_name.', Voucher No: '.$voucher_no.'">';
												echo $productInfo['name'];
                                                echo "<br>";
												echo "Serial:" . $productInfo['product_details'] . ", " . "Warranty: " . $productInfo['warranty_days'] . " Days";
                                                echo "</p>";
                                                break;
											}
										}
									}
                                ?>
                            </td>
                            <td><?php echo $value['quantity']; ?></td>
                            <td>TK <?php echo round(($value['total'] / $value['quantity']), 2); ?></td>
                            <td>TK <?php echo round($value['total'], 2) ?></td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm"
                                onclick="
                                if(confirm('Do you really want to remove this product from this invoice?')){
                                    window.location.href = 'core/product_return_delete.php?invoice_id=<?php echo $invoice_id; ?>&product_id=<?php echo $productInfo['id']; ?>&invoice_item_id=<?php echo $value['id']; ?>';
                                }"><span class="bx bx-trash"></span></a>                                
                            </td>
                        </tr>	
                        <?php
                                }
                            }else{
                                echo "<tr><td colspan='6'><h5 class='text-center text-danger'>No Item Found..!</h5></td><tr>";
                            }
                        ?>                                                                      
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6">
                        
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <div class="mb-1">Grand Total: <strong>TK<?php echo $invoiceInfo['total'] + $invoiceInfo['discount'] ?></strong></div>
                            <div class="mb-1">Total Discount: TK<?php echo $invoiceInfo['discount'] + $invoiceInfo['edit_discount'] ?></div>
                            <div class="mb-1">Sub - Total Amount: TK<?php echo $invoiceInfo['total'] - $invoiceInfo['edit_discount'] ?></div>
                            <div class="mb-1">Paid Total: TK<?php echo $invoiceInfo['pay'] ?></div>
                            <div class="mb-1">Total Due: TK<?php echo $invoiceInfo['due'] ?></div>
                            <br><br><br>
                            <h5><span class="px-2" style="border-top: 1px solid black;">Satkania CEC</span></h5>
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
<?php } ?>
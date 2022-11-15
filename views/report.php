<?php 
    include('api/customers.php');
?>


<div class="pb-2 text-center" id="message_section"></div>

<div class="container">
    <div class="card" style="border-radius: 0px;">
        <div class="card-header bg-primary text-white">
            <h4 class="m-0">See Report</h4>
        </div>
        <div class="card-body pt-4">
            <form class="form-vertical" id="addInvoice" name="addInvoice" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                <div class="panel-body">
                    <div class="row">
                        <div id="error"></div>     
                        
                        <div class="col-sm-12" id="customer_section_1">
                            <div class="form-group row">
                                <label for="customer_name" class="col-md-2 col-form-label">Customers <i class="text-danger">*</i></label>
                                <div class="col-md-3">
                                    <select class="form-control select2" id="customer_id" onchange="Customer(this.value)" required>
                                        <option selected disabled>-- Select Customer --</option>
                                        <?php
                                            if(isset($customersData)){
                                                foreach ($customersData as $key => $value) {
                                                    echo "<option value='".$value['id']."'>".$value['customer_name']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>

                                    <input class="hidden_value" type="hidden" name="customer_id" id="InvCustomerId" require readonly>
                                    <input class="hidden_value" type="hidden" name="customer_name" id="InvCustomerName" require readonly>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" autocomplete="off" name="customer_phone" id="InvCustomerPhone" class=" form-control" placeholder="Customer Phone No" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <a href="customer.php" class="btn btn-success btn-sm">New Customer</a>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-9 pt-2">
                                    <input type="text" name="customer_address" autocomplete="off" class=" form-control" placeholder="Customer Address" id="InvCustomerAddress" readonly>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="card" style="border-radius: 0px;">
                        <h4 class="bg-primary p-3">Invoice List</h4>
                        <div class="px-2 table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Invoice ID</th>
                                        <th class="text-center">Customer Name</th>
                                        <th class="text-center">Reference</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Due</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTable">
                                    <?php
                                        if(isset($invoiceData) && (count($invoiceData) > 0)){
                                            foreach ($invoiceData as $key => $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                                echo "#" . $value['invoice_id'];

                                                if($value['due'] > 0){
                                                    echo "<span style='display: none;'> due</span>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $customer_id = $value['customer_id'];
                                                if(isset($customersData)){
                                                    foreach ($customersData as $customerInfo) {
                                                        if($customer_id == $customerInfo['id'] ){
                                                            echo $customerInfo['customer_name'];
                                                            break;
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $value['reference']; ?></td>
                                        <td><?php echo $value['total']; ?> TK</td>
                                        <td><?php echo $value['due']; ?> TK</td>
                                        <td><?php echo date('d M Y', strtotime($value['created'])) ?></td>
                                        <td>
                                            <a href="invoice-details.php?invoice_id=<?php echo $value['id']; ?>" class="btn btn-sm bg-primary">View</a>
                                            <a href="#edit_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-success">Pay Amount</a>
                                        </td>
                                    </tr>
                                        

                                    <!-- Edit Modal -->
                                        <div class="modal fade" id="edit_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Due</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="core/invoice-edit.php">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <input type="hidden" name="invoice_id" value="<?php echo $value['id']; ?>" required readonly>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="pay" class="col-form-label">Pay Amount:</label>
                                                                        <input type="number" class="form-control" name="pay" value="<?php echo $value['pay']; ?>" placeholder="Enter  Amount (number)" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="discount" class="col-form-label">Discount:</label>
                                                                        <input type="number" class="form-control" name="discount" value="<?php echo $value['edit_discount']; ?>" placeholder="Enter Amount (number)" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row justify-content-center w-100">
                                                                <div class="col-12 text-center">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <?php
                                            }
                                        }else{
                                            echo "<tr><td colspan='7' class='text-center text-danger'><h5>No Data Found..!</h5></td></tr>";
                                        } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


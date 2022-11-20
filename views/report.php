<?php 
    include('api/customers.php');
?>


<div class="pb-2 text-center" id="message_section"></div>

<div class="container">
    
    <?php
        if(isset($_POST['customer_id'])){
    ?>
    <div class="row">
        <div class="col-md-12 mx-auto">
            <a class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" href="report.php"> Search Again </a>
            <div class="card" style="border-radius: 0px;">
                <h4 class="bg-primary p-3">Invoice Report History</h4>
                <div class="px-2 table-responsive">
                    <table class="table table-striped table-hover text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center">Invoice ID</th>
                                <th class="text-center">Reference</th>
                                <th class="text-center">Pay</th>
                                <th class="text-center">Due</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $customer_id = htmlentities(addslashes($_POST['customer_id']));
                                $inv_sql = "SELECT * FROM `invoices` WHERE `customer_id` = '$customer_id' ORDER BY id DESC";
                                $inv_result = mysqli_query($conn, $inv_sql);
                                if(mysqli_num_rows($inv_result) > 0){
                                    $total_pay = 0;
                                    $total_due = 0;
                                    $total_amount = 0;
                                    while($inv_row = mysqli_fetch_assoc($inv_result)){
                                        $total_pay += $inv_row['pay'];
                                        $total_due += $inv_row['due'];
                                        $total_amount += $inv_row['total'];
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
                                <td><?php echo $inv_row['reference']; ?></td>
                                <td><?php echo $inv_row['pay']; ?> TK</td>
                                <td><?php echo $inv_row['due']; ?> TK</td>
                                <td><?php echo $inv_row['total']; ?> TK</td>
                                <td><?php echo date('d M Y', strtotime($inv_row['created'])) ?></td>
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
                            echo "<h6 class='text-right mb-1'>Total Pay: &nbsp; &nbsp; &nbsp; &nbsp;<b>$total_pay</b> TK</h6>";
                            echo "<h6 class='text-right mb-1'>Total Due: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>$total_due</b> TK</h6>";
                            echo "<h6 class='text-right mb-1'>Total Amount: <b>$total_amount</b> TK</h6>";
                        }
                    ?>
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


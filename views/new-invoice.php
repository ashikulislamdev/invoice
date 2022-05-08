<?php 
    include('api/customers.php');
?>


<div class="pb-2 text-center" id="message_section"></div>

<div class="container">
    <div class="card" style="border-radius: 0px;">
        <div class="card-header bg-primary text-white">
            <h4 class="m-0">Add New Invoice</h4>
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
                                    <select class="form-control" id="customer_id" onchange="Customer(this.value)" required>
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
                    <div class="form-group row">
                        <label for="invoice_date" class="col-sm-2 col-form-label">Date <i class="text-danger">*</i></label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" autocomplete="off" required="" id="invoice_date" name="invoice_date" placeholder="yyyy-mm-dd">
                        </div>
                    </div>  

                    <div class="table-responsive" style="margin-top: 10px">
                        <table class="table table-bordered table-hover" id="normalInvoice">
                            <thead>
                                <tr>
                                    <th class="text-center">Item Information <i class="text-danger">*</i></th>
                                    
                                    <th class="text-center">Available Qty</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Rate <i class="text-danger">*</i></th>
                                    <th class="text-center">Total 
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="addInvoiceItem">
                                <tr id="invoiceItem1">
                                    <td style="width: 220px">
                                        <select name="product_id[]" class="form-control invoiceProducts" id="productItem1" data-row="invoiceItem1" required>
                                            <option  selected disabled>-- Select Product --</option>
                                        </select>
                                        <input type="hidden" name="product_name[]" class="invoiceProductName">
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="available_quantity[]" class="form-control invoiceAvailableQty" value="" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="product_quantity[]" class="form-control invoiceOrderQty" placeholder="0" data-row="invoiceItem1" required>
                                    </td>
                                    <td style="width: 150px">
                                        <input name="sale_price[]" class="form-control invoiceProductSalePrice" readonly>
                                        <input type="hidden" name="supplier_price[]" class="invoiceProductSupplierPrice">
                                    </td>
                                    
                                    <td style="width: 150px">
                                        <input class="form-control invoiceTotalPrice" name="total_price[]" readonly type="number">
                                    </td>

                                    <td class="text-center">                                            
                                        <button type="button" name="rowRemove" data-row="invoiceItem1" class="btn btn-danger btn-sm rowRemove"><span class="fa fa-trash"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                
                                <tr>
                                    <td style="text-align:right;" colspan="5"><b>Total Discount:</b></td>
                                    <td class="text-right">
                                        <input type="number" id="total_discount" class="form-control" name="total_discount" placeholder="0" onkeyup="totalDiscount()">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align:right;"><b>Grand Total:</b></td>
                                    <td class="text-right">
                                        <input id="grandTotal" class="form-control" name="grand_total" value="0" readonly type="number">
                                        <input id="grandTotalHidden" class="form-control" name="grand_total_hidden" value="0" readonly type="hidden">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <input id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onclick="addNewRow();" value="Add New Item" tabindex="6" type="button">
                                    </td>
                                    <td style="text-align:right;" colspan="3"><b>Paid Amount:</b></td>
                                    <td class="text-right">
                                        <input id="paidAmount" autocomplete="off" class="form-control" name="paid_amount" onkeyup="invoicePaidAmount();" placeholder="0" type="number">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <input id="invoice_submit" class="btn btn-success" name="add-invoice" value="Submit" tabindex="9" type="button">
                                        <input id="full_paid_tab" class="btn btn-warning" onclick="fullPaidAmount();" value="Full Paid" type="button">
                                    </td>
                                    <td style="text-align:right;" colspan="3"><b>Total Due:</b></td>
                                    <td class="text-right">
                                        <input id="dueAmount" class="form-control" name="due_amount" value="0" readonly="" type="number">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>                            
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


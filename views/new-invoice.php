
<div class="container">
    <div class="card" style="border-radius: 0px;">
        <div class="card-header bg-primary text-white">
            <h4 class="m-0">Add New Invoice</h4>
        </div>
        <div class="card-body pt-4">
            <form class="form-vertical" id="addinvoice" name="addinvoice" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                <div class="panel-body">
                    <div class="row"> 
                        <div id="error"></div>                       
                        <div class="col-sm-12" id="customer_section_1">
                            <div class="form-group row">
                                <label for="customer_name" class="col-md-2 col-form-label">Customers <i class="text-danger">*</i></label>
                                <div class="col-md-3">
                                    <select class="form-control" name="customer_id" id="customer_id" required>
                                        <option value="">-- Select Customer --</option>
                                        <option value="">Rahim</option>
                                        <option value="">Karim</option>
                                    </select>

                                    <input id="customer_name" class="hidden_value" type="hidden" name="customer_name" require readonly>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" autocomplete="off" name="customer_phone" class=" form-control" placeholder="Customer Phone No" id="customer_phone" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <a href="customer.php" class="btn btn-success btn-sm">New Customer</a>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-9 pt-2">
                                    <input type="text" name="customer_address" autocomplete="off" class=" form-control" placeholder="Customer Address" id="customer_address" readonly>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="datepicker_invoice_date" class="col-sm-2 col-form-label">Date <i class="text-danger">*</i></label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" autocomplete="off" required="" id="datepicker_invoice_date" name="datepicker_invoice_date" placeholder="yyyy-mm-dd">
                        </div>
                    </div>  

                    <div class="table-responsive" style="margin-top: 10px">
                        <table class="table table-bordered table-hover" id="normalinvoice">
                            <thead>
                                <tr>
                                    <th class="text-center">Item Information <i class="text-danger">*</i></th>
                                    
                                    <th class="text-center">Available Qty</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Rate <i class="text-danger">*</i></th>
                                    <th class="text-center">Discount/item </th>
                                    <th class="text-center">Total 
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="addinvoiceItem">
                                <tr>
                                    <td style="width: 220px">
                                        <select name="product_id[]" class="form-control" required>
                                            <option value="">-- Select Product --</option>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="available_quantity[]" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="product_quantity[]" class="form-control" placeholder="0.00" required>
                                    </td>
                                    <td style="width: 150px">
                                        <input name="product_rate[]" class="form-control" readonly> 
                                    </td>
                                    <!-- Discount -->
                                    <td>
                                        <input name="discount[]" type="text"class="form-control" placeholder="0.00">
                                    </td>
                                    
                                    <td style="width: 150px">
                                        <input class="total_price form-control" name="total_price[]" id="total_price_1" value="" tabindex="-1" readonly="" type="text">
                                    </td>

                                    <td>                                            
                                        <button class="btn btn-danger btn-sm mx-auto" type="button" onclick="deleteRow(this)" value="Delete">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                
                                <tr>
                                    <td style="text-align:right;" colspan="5"><b>Total Discount:</b></td>
                                    <td class="text-right">
                                        <input id="total_discount_ammount" class="form-control" name="total_discount" tabindex="-1" value="0.00" readonly="" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align:right;"><b>Grand Total:</b></td>
                                    <td class="text-right">
                                        <input id="grandTotal" class="form-control" name="grand_total_price" value="0.00" tabindex="-1" readonly="" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <input id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onclick="addInputField('addinvoiceItem');" value="Add New Item" tabindex="6" type="button">
                                    </td>
                                    <td style="text-align:right;" colspan="3"><b>Paid Amount:</b></td>
                                    <td class="text-right">
                                        <input id="paidAmount" autocomplete="off" class="form-control" name="paid_amount" onkeyup="invoice_paidamount();" value="" placeholder="0.00" tabindex="7" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">
                                        <input id="add-invoice" class="btn btn-success" name="add-invoice" value="Submit" tabindex="9" type="submit">
                                        <input id="full_paid_tab" class="btn btn-warning" name="" onclick="full_paid();" value="Full Paid" tabindex="8" type="button">
                                    </td>
                                    <td style="text-align:right;" colspan="3"><b>Total Due:</b></td>
                                    <td class="text-right">
                                        <input id="dueAmmount" class="form-control" name="due_amount" value="0.00" readonly="" type="text">
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
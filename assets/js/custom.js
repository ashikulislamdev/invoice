// Get Customer Data by onchange in add invoice
function Customer(id){
    $(".loader_overlay").show();
    $.ajax({
        type : 'POST',
        url : 'ajax/customer-details.php',
        data : {customer_id : id},
        success : function(data){
            var res = JSON.parse(data);
            
            if(res.status == true){
                $(".loader_overlay").hide();
                $('#InvCustomerId').val(res.collection.id);
                $('#InvCustomerName').val(res.collection.customer_name);
                $('#InvCustomerPhone').val(res.collection.customer_phone);
                $('#InvCustomerAddress').val(res.collection.address);
            }else{
                alert("No Data Found..!");
            }
        }
    });
}


// Add New Table Row in Invoice Table
var rowCount = 1;

function addNewRow(e){
    rowCount = rowCount + 1;

    $("#addInvoiceItem").append('<tr id="invoiceItem' + rowCount + '"><td style="width: 220px"><select name="product_id[]" class="form-control invoiceProducts" id="productItem' + rowCount + '" data-row="invoiceItem'+rowCount+'" required><option selected disabled>-- Select Product --</option></select><input type="hidden" name="product_name[]" class="invoiceProductName"></td><td><input type="number" name="available_quantity[]" class="form-control invoiceAvailableQty" data-row="invoiceItem1" readonly></td><td><input type="number" name="product_quantity[]" class="form-control invoiceOrderQty" placeholder="0" data-row="invoiceItem'+rowCount+'" required></td><td style="width: 150px"><input name="product_rate[]" class="form-control invoiceProductSalePrice" readonly><input type="hidden" name="supplier_price[]"  class="invoiceProductSupplierPrice"></td><td style="width: 150px"><input class="form-control invoiceTotalPrice" name="total_price[]" readonly type="number"><input class="form-control invoiceTotalSupplierPrice" name="total_supplier_price[]" readonly type="hidden"></td><td class="text-center"><button type="button" name="rowRemove" data-row="invoiceItem'+rowCount+'" class="btn btn-danger btn-sm rowRemove"><span class="fa fa-trash"></span></button></td></tr>');
    productList('productItem' + rowCount);
}


// Remove row from invoice table
$(document).on("click", ".rowRemove", function(a){
    a.preventDefault();
    var delete_row = $(this).data("row");
    //alert(delete_row);
    $('#' + delete_row).remove();

    grandTotal();
    totalDiscount();
    invoicePaidAmount();
});

// Show Dynamical Product List
function productList($productItem){
    $.ajax({
        url : 'ajax/table-product-list.php',
        success : function(data){
            var res = JSON.parse(data);
            
            if(res.status == true){
                var text = '';
    
                // console.log(res.collection);
    
                res.collection.forEach(element => {
                    if(element.quantity > 0){
                        $("#" + $productItem).append("<option value='"+element.id+"'>"+element.name+"</option>");
                    }                    
                });
            }
        }
    });
}
productList('productItem1');



// Get product Details by onchange in add invoice
$(document).on("change", ".invoiceProducts", function(a){
        var row = $(this).data("row");
        var product_id = $(this).val();

        $(".loader_overlay").show();
        $.ajax({
            type : 'POST',
            url : 'ajax/product-details.php',
            data : {product_id : product_id},
            success : function(data){
                $(".loader_overlay").hide();
                var res = JSON.parse(data);

                if(res.status == true){
                    $("#"+row+" .invoiceProductName").val(res.collection.name);
                    $("#"+row+" .invoiceAvailableQty").val(res.collection.quantity);
                    $("#"+row+" .invoiceProductSalePrice").val(res.collection.sale_price);
                    $("#"+row+" .invoiceProductSupplierPrice").val(res.collection.supplier_price);
                    $("#"+row+" .invoiceTotalPrice").val(0);
                    $("#"+row+" .invoiceOrderQty").val(null);
                    $("#"+row+" .invoiceProductDiscount").val(null);
                }else{
                    alert("No Data Found..!");
                }
            }
        });

        // $("#"+row+" .invoiceOrderQty").val(123);
});


// Change Invoice Quantity
$(document).on("keyup", ".invoiceOrderQty", function(a){
    var selector = $(this).data("row");
    var quantity = $('#' + selector + " .invoiceOrderQty").val();

    var product = $('#' + selector + " .invoiceProducts").val();
    var available_quantity = $('#' + selector + " .invoiceAvailableQty").val();
    var price = $('#' + selector + " .invoiceProductSalePrice").val();
    var supplier_price = $('#' + selector + " .invoiceProductSupplierPrice").val();
    var total = $('#' + selector + " .invoiceTotalPrice").val();

    var checkQry = available_quantity - quantity;

    if(product != null){
        if(checkQry < 0){
            alert('available quantity is ' + available_quantity);
            $('#' + selector + " .invoiceOrderQty").val('');
            $('#' + selector + " .invoiceTotalPrice").val('');
        }else{
            var total_amount = price * quantity;
            var supplier_total_amount = supplier_price * quantity;
            $('#' + selector + " .invoiceTotalSupplierPrice").val(supplier_total_amount);
            $('#' + selector + " .invoiceTotalPrice").val(total_amount);
        }
        grandTotal();
        totalDiscount();
        invoicePaidAmount();
    }else{
        alert("Please select a product");
        $('#' + selector + " .invoiceOrderQty").val('');
    }
});

// Grand total
function grandTotal(){
    var elements = document.getElementsByClassName('invoiceTotalPrice');

    var myLength = elements.length,
    total = 0;

    for (var i = 0; i < myLength; ++i) {
        total = total + +elements[i].value;
        // console.log(total);
    }

    $('#grandTotal').val(total);
    $('#grandTotalHidden').val(total);
}
grandTotal();


// Total discount 
function totalDiscount(){
    var total_discount = $("#total_discount").val();
    var grand_total_hidden = $('#grandTotalHidden').val();

    var grand_total = grand_total_hidden - total_discount;

    if(grand_total < 0){
        alert('Discount should be less than grand total');
        $("#total_discount").val('');
        grandTotal();
    }else{
        $('#grandTotal').val(grand_total);
    }
    invoicePaidAmount();
}

// Total Paid Amount
function invoicePaidAmount(){
    var paid_amount = $('#paidAmount').val();
    var grand_total = $('#grandTotal').val();

    var total = grand_total - paid_amount;

    if(total < 0){
        alert('Paid amount should be less than grand total');
        $("#paidAmount").val('');
        $("#dueAmount").val(grand_total);
    }else{
        $('#dueAmount').val(total);
    }
}


// Full Paid Amount
function fullPaidAmount(){
    var grand_total = $('#grandTotal').val();

    $("#paidAmount").val(grand_total);
    $("#dueAmount").val(0);
}


// Invoice Submit
$("#invoice_submit").on("click", function(){
    var form = $("#addInvoice").serialize();
    // console.log(form);

    $(".loader_overlay").show();
    $.ajax({
        type : 'POST',
        url : 'ajax/add-invoice.php',
        data : form,
        success : function(data){
            $("#message_section").html(data);
            $(".loader_overlay").hide();
        }
    });
});


// Search in table

$(document).ready(function(){
    $(".search-input-box").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
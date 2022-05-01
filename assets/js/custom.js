// Get Customer Data by onchange in add invoice
function Customer(id){
    $.ajax({
        type : 'POST',
        url : 'ajax/customer-details.php',
        data : {customer_id : id},
        success : function(data){
            var res = JSON.parse(data);
            
            if(res.status == true){
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

    $("#addInvoiceItem").append('<tr id="invoiceItem' + rowCount + '"><td style="width: 220px"><select name="product_id[]" class="form-control invoiceProducts" id="productItem' + rowCount + '" data-row="invoiceItem'+rowCount+'" required><option selected disabled>-- Select Product --</option></select><input type="hidden" name="product_name[]" class="invoiceProductName"></td><td><input type="number" name="available_quantity[]" class="form-control invoiceAvailableQty" readonly></td><td><input type="number" name="product_quantity[]" class="form-control invoiceOrderQty" placeholder="0.00" data-row="invoiceItem'+rowCount+'" required></td><td style="width: 150px"><input name="product_rate[]" class="form-control invoiceProductSalePrice" readonly><input type="hidden" name="supplier_price[]" class="invoiceProductSupplierPrice"></td><td><input name="discount[]" type="number"class="form-control invoiceProductDiscount" data-row="invoiceItem'+rowCount+'" placeholder="0.00"></td><td style="width: 150px"><input class="form-control invoiceTotalPrice" name="total_price[]" readonly type="number"></td><td><button type="button" name="rowRemove" data-row="invoiceItem'+rowCount+'" class="btn btn-danger btn-sm rowRemove"><span class="fa fa-trash"></span></button></td></tr>');
    productList('productItem' + rowCount);
}


// Remove row from invoice table
$(document).on("click", ".rowRemove", function(a){
    a.preventDefault();
    var delete_row = $(this).data("row");
    //alert(delete_row);
    $('#' + delete_row).remove();
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
                    $("#" + $productItem).append("<option value='"+element.id+"'>"+element.name+"</option>");
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

        $.ajax({
            type : 'POST',
            url : 'ajax/product-details.php',
            data : {product_id : product_id},
            success : function(data){
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


$(document).on("keyup", ".invoiceOrderQty", function(a){
    var selector = $(this).data("row");
    var quantity = $('#' + selector + " .invoiceOrderQty").val();

    var product = $('#' + selector + " .invoiceProducts").val();
    var available_quantity = $('#' + selector + " .invoiceAvailableQty").val();
    var discount = $('#' + selector + " .invoiceProductDiscount").val();
    var total = $('#' + selector + " .invoiceTotalPrice").val();

    // quantity = 1;
    // available_quantity = 100;

    if(product != null){
        if(quantity > available_quantity){
            // alert(available_quantity);
            console.log(available_quantity);
        }else{
            // alert(available_quantity);
        }
    }else{
        alert("Please select a product");
    }
});





// function productQuantity($value, $selector){
//     var quantity = $value;
//     var selector = $selector;

//     var product = $('#' + selector + " .invoiceProducts").val();
//     var available_quantity = $('#' + selector + " .invoiceAvailableQty").val();
//     var discount = $('#' + selector + " .invoiceProductDiscount").val();
//     var total = $('#' + selector + " .invoiceTotalPrice").val();

    

//     if(product != null){
//         if(quantity >= available_quantity){
//             alert(available_quantity);
//         }else{
//             // alert(available_quantity);
//         }
//     }else{
//         alert("Please select a product");
//     }    
// }
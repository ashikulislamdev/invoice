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


// Get Products Data by onchange in add invoice
function Products(id){
    $('#productList').change(function(){
        var id = $(this).find(':selected')[0].id;
        $.ajax({
            type : 'POST',
            url : 'ajax/product-details.php',
            data : {product_id : id},
            dataType: 'json',
            success : function(data){
                $('availableProductQty').text(data.quantity);
            }
        });
    });
}


// Add New Table Row in Invoice Table
var rowCount = 1;

function addNewRow(e){
    rowCount = rowCount + 1;

    $("#addInvoiceItem").append('<tr id="invoiceItem' + rowCount + '"><td style="width: 220px"><select name="product_id[]" class="form-control tableProductList" id="productItem' + rowCount + '" required><option selected disabled>-- Select Product --</option></select></td><td><input type="text" name="available_quantity[]" class="form-control" readonly></td><td><input type="text" name="product_quantity[]" class="form-control" placeholder="0.00" required></td><td style="width: 150px"><input name="product_rate[]" class="form-control" readonly> </td><td><input name="discount[]" type="text"class="form-control" placeholder="0.00"></td><td style="width: 150px"><input class="total_price form-control" name="total_price[]" id="total_price_1" readonly type="text"></td><td><button type="button" name="rowRemove" data-row="invoiceItem'+rowCount+'" class="btn btn-danger btn-sm rowRemove"><span class="fa fa-trash"></span></button></td></tr>');
    productList('productItem' + rowCount);
}

$(document).on("click", ".rowRemove", function(a){
    a.preventDefault();
    var delete_row = $(this).data("row");
    $('#' + delete_row).remove();
});


function productList($productItem){
    $.ajax({
        url : 'ajax/table-product-list.php',
        success : function(data){
            var res = JSON.parse(data);
            
            if(res.status == true){
                var text = '';
    
                console.log(res.collection);
    
                res.collection.forEach(element => {
                    $("#" + $productItem).append("<option>"+element.name+"</option>");
                });
            }
        }
    });
}
productList('productList');
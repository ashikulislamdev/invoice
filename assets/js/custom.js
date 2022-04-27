
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
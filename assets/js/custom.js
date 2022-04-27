
    function Customer(id){
        alert(id);
        $.ajax({
            type : 'POST',
            url : '../ajax/customer-details.php',
            data : {customer_id : id},
            success : function(data){
                //$('.district').html(data);
                alert(data);
            }
        });
    }
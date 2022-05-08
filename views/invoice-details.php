<div id="printSection">
    <div class="col-12 mx-auto" style="width: 800px;">
        <div class="card p-0" style="border-radius: 0px;">
            <div class="card-header p-2 px-3" style="background-color: #c7c7c7; border-radius: 0px;">
                <h5 class="float-left mb-0">Invoice #5</h5>
                <div class="float-right">November 05, 2021</div>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-8">										
                        <img src="http://satkaniacec.com/images/1618865702_RB_Logo%202.png" style="height: 80px;">
                        <h5>Satkania CEC,</h5>
                        <p><a class="text-primary" href="#"><span class="underline">www.satkaniacec.com</span></a></p>
                        <p>Keranihat, Satkania<br>Chattogram<br>Bangladesh</p>
                        <p>Phone: 01815 070747</p>
                        
                        </div>
                    <div class="col-4">
                        <h5 class="pb-2">Invoice To:</h5>
                                                            
                        <p class="m-0">MD Rabiull,</p>
                        <p class="m-0">Chattogram</p>
                        <p class="m-0">Phone: 01601308010</p>
                        <hr class="hr">
                        <p>Invoice created by: Admin</p>                                        
                                                                                                    
                    </div>

                </div>
                
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Item Information</th>                                        
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Rate</th>
                        <th class="text-center">Discount/item</th>
                        <th class="text-center">Total</th>                                        
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>Steel Bar</td>
                            <td>1</td>
                            <td>TK												
                            2000 / None											
                            </td>
                            <td>TK0</td>
                            <td>TK2000</td>
                        </tr>	
                                                                                                
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <div class="mb-1">Sub - Total Amount: TK2000</div>
                            <div class="mb-1">Total Discount: TK0</div>
                            <div class="mb-1">Grand Total: <strong>TK2000</strong></div>
                            <div class="mb-1">Paid Total: TK2000</div>
                            <div class="mb-1">Total Due: TK0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 text-center">
    <button onclick="printSection()" class="btn btn-info btn-lg py-2" style="width: 150px;"><span class="btn-label"><i class="ti-printer"></i></span> Print Now</button>
</div>






<script>
	function printSection() {
		var divContents = document.getElementById("printSection").innerHTML;
		var a = window.open('', '', 'height=1000px, width=1000px');
		a.document.write('<html><head>');
		a.document.write("<meta name='author' content='codedthemes'><link rel='icon' href='assets/images/favicon.ico' type='image/x-icon'><link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet'><link rel='stylesheet' type='text/css' href='assets/css/bootstrap/css/bootstrap.min.css'><link rel='stylesheet' type='text/css' href='assets/icon/themify-icons/themify-icons.css'><link rel='stylesheet' type='text/css' href='assets/icon/font-awesome/css/font-awesome.min.css'><link rel='stylesheet' type='text/css' href='assets/icon/icofont/css/icofont.css'><link rel='stylesheet' type='text/css' href='assets/css/style.css'><link rel='stylesheet' type='text/css' href='assets/css/jquery.mCustomScrollbar.css'>");
		a.document.write("<style>.pcoded-main-container{background: white;} body{background-color: white;}</style>");
		a.document.write('</head><body>');
		a.document.write(divContents);
		a.document.write('</body></html>');
		a.document.close();
		a.print();
	}
</script>
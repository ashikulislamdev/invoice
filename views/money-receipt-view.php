<div id="printSection" class="mx-auto">
    <div class="col-md-12" style="width: 800px;">
        <div class="row justify-content-center mx-auto">
            <div class="text-center col-12">
                <div class="row justify-content-center">
                    <div class="col-1 p-0 text-right">
                        <img src="images/1802476607.png" style="width: 85px;">
                    </div>
                    <div class="col-9 text-center">
                        <h3 class="pt-2">
                            Satkania Community E-Center                                            
                        </h3>
                        <p class="font-weight-bold pb-2 mb-0">
                            UTDC Building, 1st Floor, Upazila Complex, Satkania, Chattogram                                            
                        </p>
                        <h6>satkaniacec@gmail.com</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-3">
                <div class="row justify-content-between my-2">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-6 pr-0">
                                <label><b>Recive No &nbsp; &nbsp; &nbsp;:</b></label>
                            </div>
                            <div class="col-6 px-o">
                                <input type="text" class="form-control" style="border-radius: 0px; border: 2px solid gray; cursor: no-drop;" value="1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <span class="bg-dark text-light p-1 mx-auto" style="font-size: 25px; font-family: cursive;"> Money Receipt </span>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-4 pr-0">
                                <label>Date : </label>
                            </div>
                            <div class="col-8 pl-0">
                                <input type="text" class="form-control" value="19-Oct-2021" style="border-radius: 0px; border: 2px solid gray; cursor: no-drop;" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pb-2">
                <div style="display: grid; grid-template-columns: 128px auto;">
                    <div>
                        <label><b>Customer &nbsp; &nbsp; &nbsp; :</b></label>
                    </div>
                    <div>
                        <input type="text" value="MD Rabiull Hassan" class="form-control" readonly style="border: 2px solid gray; border-radius: 0px; cursor: no-drop;">
                    </div>
                    <div class="pt-2">
                        <label><b>Address &nbsp; &nbsp; :</b></label>
                    </div>
                    <div class="pt-2">
                        <input type="text" value="Satkania, Chattogram" class="form-control" readonly style="border: 2px solid gray; border-radius: 0px; cursor: no-drop;">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table" border="3" style="border-color: black; width: 100%;">
                    <thead>
                        <tr style="border-bottom: 3px solid black;">
                            <th style="width: 8%; color:black;text-align: center;">SL. NO</th>
                            <th style="width: 50%; color:black; border-left: 3px solid black; border-right: 3px solid black;text-align: center;">Particulars</th>
                            <th style="width: 15%; color:black;text-align: center;">Taka</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td style="border-left: 3px solid black; border-right: 3px solid black;">Session Fee</td>
                            <td class="text-center">1600</td>
                        </tr>
                        <tr style="border-top: 3px solid black;">
                            <td class="text-center"></td>
                            <td class="p-0 m-0 text-right" style=" border-left: 3px solid black; border-right: 3px solid black;">
                                <h5 class="font-weight-bold pt-2">Total &nbsp;</h5>
                            </td>
                            <td class="text-center p-0 m-0">
                                <input type="text" value="1600" class="form-control text-center" style="cursor: no-drop;" id="total_amount" readonly>                                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <label>In Word:</label>
                        </div>
                        <div class="col-10 px-0">
                            <input type="text" name="taka_in_word" class="form-control" id="amount-print" style="border-radius: 0px; cursor: no-drop;" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="row ">
                        <div class="col-3 text-center ml-auto">
                            <h4 style="border-top: 1px solid black;">Accountant</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 text-center">
    <button onclick="printSection()" class="btn btn-primary btn-lg py-2">Print Now</button>
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
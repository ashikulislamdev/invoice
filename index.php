<?php
    
    $cookie_name =  md5(trim("udduktaInv"));
    if (isset($_COOKIE[$cookie_name])) {
		echo "<script>location.href='dashboard.php'</script>";
		die();
	}
    include('includes/header.php');

?>

<body>
	  
	<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" id="login_form" method="POST" onsubmit="return false">
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h5 class="text-dark">মোহাম্মদিয়া কম্পিউটার</h5>
                                        <h3 class="text-center txt-primary">Sign In</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div id="msg_area"></div>
                                <div class="input-group">
                                    <input type="username" name="username" class="form-control" placeholder="Username" id="username">
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                                </div>
                                <div class="input-group">
                                    <input type="hidden" name="login_status" class="form-control" value="true" id="login_status">
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right d-none">
                                        <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" id="login_btn">Sign in</button>
                                    </div>

                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-inverse text-center m-b-0">Thank you and enjoy our Software.</p>
                                        <p class="text-inverse text-center"><b>Develop by <a href="#" class="text-primary">CNS</a></b></p>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>


    <?php include('includes/footer.php'); ?>

        <script>
            $(document).ready(function(){
                $("#login_form").on("submit", function(){

                    $("#login_btn").addClass("btn-disabled");
                    $("#login_btn").html("Processing...");

                    $.ajax({
                        url : "ajax/login.php",
                        type : "POST",
                        data : $("#login_form").serialize(),
                        success : function(data){
                            $("#msg_area").html(data).fadeIn;
                            $("#login_btn").removeClass("btn-disabled");
                            $("#login_btn").html("Sign in");
                        }
                    })
                })
            })

        </script>
    </body>
</html>
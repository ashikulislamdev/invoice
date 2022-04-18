<?php 
    include('session.php');
    
    if(isset($conn)){
        $navInfo = "SELECT * FROM `instituteInfo` WHERE `id` = '1'";
        $runNavInfo = mysqli_query($conn, $navInfo);

        if($runNavInfo){
            if(mysqli_num_rows($runNavInfo) > 0){
                while($navData = mysqli_fetch_assoc($runNavInfo)){
                    $instituteName = $navData['instituteName'];
                    $instituteLogo = $navData['instituteLogo'];
                    $instituteEmail = $navData['instituteEmail'];
                    $institutePhone = $navData['institutePhone'];
                }
            }
        }
    }

    include('includes/header.php');
?>

  <body>
	  <div class="fixed-button">
		<a href="https://codedthemes.com/item/gradient-able-admin-template" target="_blank" class="btn btn-md btn-primary">
			<i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
		</a>
	  </div>
       <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            

            <!-- Navbar -->

            <?php include('includes/navbar.php'); ?>

            <!-- Navbar End -->
            
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    
                
                    <!-- Side Navbar -->

                    <?php include("includes/side_navbar.php"); ?>


                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                      <div class="row">

                                           <?php

                                                if(isset($views)){
                                                    if($views == 'dashboard'){
                                                        include("views/dashboard-view.php");
                                                    }else if($views == 'profile'){
                                                        include("views/profile.php");
                                                    }else if($views == 'money-receipt'){
                                                        include("views/money-receipt.php");
                                                    }else if($views == 'money-receipt-view'){
                                                        include("views/money-receipt-view.php");
                                                    }
                                                }
                                           
                                           ?> 
											                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include('includes/footer.php'); ?>

    </body>
</html>
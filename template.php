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
                                            <div class="col-12 pb-3 text-center">
                                                <?php
                                                
                                                    // Include Supplier API
                                                    include 'api/suppliers.php';

                                                    if(isset($_GET['action'])){
                                                        $action = trim(htmlentities(addslashes($_GET['action'])));

                                                        if($action == 'record_added'){
                                                            echo "<h5 class='text-success'>Record Added Successfully</h5>";
                                                        }else if($action == 'record_updated'){
                                                            echo "<h5 class='text-success'>Record Updated Successfully</h5>";
                                                        }else if($action == 'record_deleted'){
                                                            echo "<h5 class='text-success'>Record Deleted Successfully</h5>";
                                                        }else if($action == 'something_wrong'){
                                                            echo "<h5 class='text-danger'>Oops, Sorry Something Wrong..!</h5>";
                                                        }else if($action == 'null'){
                                                            echo "<h5 class='text-danger'>Please fill the mandatory filed.</h5>";
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>


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
                                                }else if($views == 'supplier'){
                                                    include("views/supplier.php");
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
<?php include('includes/footer.php'); ?>

    </body>
</html>
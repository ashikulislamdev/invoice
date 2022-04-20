<nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="<?php if($views == "dashboard"){echo 'active';} ?>">
                                    <a href="dashboard.php">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu <?php if($views == "money-receipt" || $views == "money-receipt-view"){echo 'active';} ?>">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="money-receipt.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Money Receipt</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="<?php if($views == "supplier"){echo 'active';} ?>">
                                    <a href="supplier.php">
                                        <span class="pcoded-micon"><i class='bx bx-user-pin text-20'></i><b>S</b></span>
                                        <span class="pcoded-mtext">Suppliers</span>
                                    </a>
                                </li>
                                <li class="<?php if($views == "customer"){echo 'active';} ?>">
                                    <a href="customer.php">
                                        <span class="pcoded-micon"><i class="bx bx-user text-20"></i><b>C</b></span>
                                        <span class="pcoded-mtext">Customers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
<?php
session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../../login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ../../login.php");
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- C3 charts css -->
        <link href="../plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />

        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left" onload="notificationHandler();">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <!--<a href="index.html" class="logo text-center">Admiria</a>-->
                        <a href="index.html" class="logo"><img src="assets/images/logo-sm.png" height="36" alt="logo"></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>

                            <li class="menu-title">Main</li>

                            <li class="has_sub">
                                <a href="index.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span> Dashboard </span></a>
                            </li>

                            <li>
                                <a href="calendar.html" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Calendar </span></a>
                            </li>

                            <li class="menu-title">Components</li>



                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-line"></i><span> Charts <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="charts-morris.html">Morris Chart</a></li>
                                    <li><a href="charts-chartist.html">Chartist Chart</a></li>
                                    <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                                    <li><a href="charts-flot.html">Flot Chart</a></li>
                                    <li><a href="charts-c3.html">C3 Chart</a></li>
                                    <li><a href="charts-sparkline.html">Sparkline Chart</a></li>
                                    <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                                    <li><a href="charts-peity.html">Peity Chart</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted-type"></i><span> Tables <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="tables-basic.html">Basic Tables</a></li>
                                    <li><a href="tables-datatable.html">Data Table</a></li>
                                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                                    <li><a href="tables-editable.html">Editable Table</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Help & Support</li>

                            <li>
                                <a href="faq.html" class="waves-effect"><i class="mdi mdi-help-circle"></i><span> FAQ </span></a>
                            </li>

                            <li>
                                <a href="contact.html" class="waves-effect"><i class="mdi mdi-headset"></i><span> Contact <span class="badge badge-pill badge-warning pull-right">3</span> </span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->


            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">
                            <!-- Search input -->
                            <div class="search-wrap" id="search-wrap">
                                <div class="search-bar">
                                    <input class="search-input" type="search" placeholder="Search" />
                                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                        <i class="mdi mdi-close-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <ul class="list-inline float-right mb-0">
                                <!-- Search -->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                                        <i class="mdi mdi-magnify noti-icon"></i>
                                    </a>
                                </li>
                                <!-- Fullscreen -->
                                <li class="list-inline-item dropdown notification-list hidden-xs-down">
                                    <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                        <i class="mdi mdi-fullscreen noti-icon"></i>
                                    </a>
                                </li>
                                <!-- language-->
                                <li class="list-inline-item dropdown notification-list hidden-xs-down">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect text-muted" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        English <img src="assets/images/flags/us_flag.jpg" class="ml-2" height="16" alt=""/>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right language-switch">
                                        <a class="dropdown-item" href="#"><img src="assets/images/flags/germany_flag.jpg" alt="" height="16"/><span> German </span></a>
                                        <a class="dropdown-item" href="#"><img src="assets/images/flags/italy_flag.jpg" alt="" height="16"/><span> Italian </span></a>
                                        <a class="dropdown-item" href="#"><img src="assets/images/flags/french_flag.jpg" alt="" height="16"/><span> French </span></a>
                                        <a class="dropdown-item" href="#"><img src="assets/images/flags/spain_flag.jpg" alt="" height="16"/><span> Spanish </span></a>
                                        <a class="dropdown-item" href="#"><img src="assets/images/flags/russia_flag.jpg" alt="" height="16"/><span> Russian </span></a>
                                    </div>
                                </li>
                                <!-- notification-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <i class="ion-ios7-bell noti-icon" onclick="notificationCount()"></i>
                                        <span class="badge badge-danger noti-icon-badge" id="notificationCount">1</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Notification (1)</h5>
                                        </div>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-checkbox-marked-circle-outline"></i></div>
                                            <p class="notify-details"><b id="notificationLoginDateHandler">Logged in on </b><small class="text-muted" id="notificationLoginTimeHandler">at saf</small></p>
                                        </a>

                                        <!-- All-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            View All
                                        </a>

                                    </div>
                                </li>
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.php?logout='1'"><i class="dripicons-exit text-muted"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>

                            <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title">Dashboard</h3>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-purple mr-0 float-right"><i class="mdi mdi-basket"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-purple">25140</span>
                                            Total Sales
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class=" mb-0 m-t-20 text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-black-mesa"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-blue-grey">65241</span>
                                            New Orders
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class="text-muted mb-0 m-t-20">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-brown mr-0 float-right"><i class="mdi mdi-buffer"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-brown">85412</span>
                                            New Users
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class="text-muted mb-0 m-t-20">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="mdi mdi-access-point-network"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-teal" id="clientCountry">Country</span>
                                            Client Info
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class="text-muted mb-0 m-t-20" id="clientIP">IP:</p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-xl-9">

                                    <div class="row">
                                        <div class="col-md-9 pr-md-0">
                                            <div class="card m-b-20" style="height: 486px;">
                                                <div class="card-body">
                                                    <h4 class="mt-0 header-title">Monthly Earnings</h4>

                                                    <div class="text-center">
                                                        <div class="btn-group m-t-20" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-secondary">Day</button>
                                                            <button type="button" class="btn btn-secondary">Month</button>
                                                            <button type="button" class="btn btn-secondary">Year</button>
                                                        </div>
                                                    </div>

                                                    <div id="combine-chart" class="m-t-20"></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-md-0">
                                            <div class=" card m-b-20" style="height: 486px;">
                                                <div class="card-body">
                                                    <div class="m-b-20">
                                                        <p>Weekly Earnings</p>
                                                        <h5>$1,542</h5>
                                                        <span class="peity-line" data-width="100%" data-peity='{ "fill": ["rgba(103,168,228,0.3)"],"stroke": ["rgba(103,168,228,0.8)"]}' data-height="60">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                    </div>
                                                    <div class="m-b-20">
                                                        <p>Monthly Earnings</p>
                                                        <h5>$6,451</h5>
                                                        <span class="peity-line" data-width="100%" data-peity='{ "fill": ["rgba(74,193,142,0.3)"],"stroke": ["rgba(74,193,142,0.8)"]}' data-height="60">6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
                                                    </div>
                                                    <div class="m-b-20">
                                                        <p>Yearly Earnings</p>
                                                        <h5>$84,574</h5>
                                                        <span class="peity-line" data-width="100%" data-peity='{ "fill": ["rgba(232, 65, 38,0.3)"],"stroke": ["rgba(232, 65, 38,0.8)"]}' data-height="60">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-3">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Sales Analytics</h4>

                                            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                                <li class="list-inline-item">
                                                    <h5 class="mb-0">25610</h5>
                                                    <p class="text-muted font-14">Activated</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="mb-0">56210</h5>
                                                    <p class="text-muted font-14">Pending</p>
                                                </li>
                                            </ul>

                                            <div id="donut-chart"></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->

                        </div><!-- container-fluid -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <footer class="footer">
                    © 2020 Refrigerg <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Me</span>
                </footer>


            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Notification js -->
        <script src="assets/js/notification.js"></script>
        

        <!-- Peity chart JS -->
        <script src="../plugins/peity-chart/jquery.peity.min.js"></script>

        <!--C3 Chart-->
        <script src="../plugins/d3/d3.min.js"></script>
        <script src="../plugins/c3/c3.min.js"></script>

        <!-- KNOB JS -->
        <script src="../plugins/jquery-knob/excanvas.js"></script>
        <script src="../plugins/jquery-knob/jquery.knob.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <!-- IP js -->
        <script src="assets/js/ip.js"></script>


    </body>
</html>
<?php
session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    unset($_SESSION['reciepe']);
    unset($_SESSION['inventory']);
	header("location: ../../login.php");
}
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>F.A.Q</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                        <a href="index.php" class="logo"><img src="https://console.dialogflow.com/api-client/assets/img/logo-short.png" height="36" alt="logo">R E F R I G E R G</a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>

                            <li class="menu-title">Main</li>

                            <li>
                                <a href="index.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span> Dashboard </span></a>
                            </li>

                            <li>
                                <a href="inventoryList.php" class="waves-effect"><i class="mdi mdi-view-list"></i><span> Inventory List </span></a>
                            </li>

                            <li class="menu-title">Misc</li>

                            <li>
                                <a href="recieperecommender.php" class="waves-effect"><i class="mdi mdi-food"></i><span> Reciepe Recommender </span></a>
                            </li>

                            <li>
                                <a href="chatbot.php" class="waves-effect"><i class="mdi mdi-shopping"></i><span> Chat Bot </span></a>
                            </li>

                            <li class="menu-title">Help & Support</li>

                            <li>
                                <a href="faq.php" class="waves-effect"><i class="mdi mdi-help-circle"></i><span> FAQ </span></a>
                            </li>

                            <li>
                                <a href="contact.php" class="waves-effect"><i class="mdi mdi-headset"></i><span> Contact </span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
                
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
                                       aria-haspopup="false" aria-expanded="false" onclick="notificationCount()">
                                        <i class="ion-ios7-bell noti-icon"></i>
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
                                        <img src="assets/images/users/marvel.png" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="userdetails.php"><i class="dripicons-user text-muted"></i> Profile</a>
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
                                    <h3 class="page-title">FAQ</h3>
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
                                <div class="col-lg-8">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Frequently Asked Questions</h4>
                                            <div class="m-t-30">
                                                <div id="accordion">
                                                    <div class="card">
                                                        <div class="card-header bg-white border-bottom-0 p-3" id="headingOne">
                                                            <h5 class="mb-0 mt-0 font-16 font-light">
                                                                <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                                   aria-controls="collapseOne" class="text-white">
                                                                   Q.1 What is Lorem Ipsum?
                                                                </a>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse show"
                                                             aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body text-muted">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                                accusamus terry richardson ad squid. 3 wolf moon officia
                                                                aute, non cupidatat skateboard dolor brunch. Food truck
                                                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                                sunt aliqua put a bird on it squid single-origin coffee
                                                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                helvetica, craft beer labore wes anderson cred nesciunt
                                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                                Leggings occaecat craft beer farm-to-table, raw denim
                                                                aesthetic synth nesciunt you probably haven't heard of them
                                                                accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white border-bottom-0 p-3" id="headingTwo">
                                                            <h5 class="mb-0 mt-0 font-16 font-light">
                                                                <a href="#" class="text-white collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Q.2 Is safe use Lorem Ipsum?
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                            <div class="card-body text-muted">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                                accusamus terry richardson ad squid. 3 wolf moon officia
                                                                aute, non cupidatat skateboard dolor brunch. Food truck
                                                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                                sunt aliqua put a bird on it squid single-origin coffee
                                                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                helvetica, craft beer labore wes anderson cred nesciunt
                                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                                Leggings occaecat craft beer farm-to-table, raw denim
                                                                aesthetic synth nesciunt you probably haven't heard of them
                                                                accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white border-bottom-0 p-3" id="headingThree">
                                                            <h5 class="mb-0 mt-0 font-16 font-light">
                                                                <a href="#" class="text-white collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Q.3 Why use Lorem Ipsum?
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                            <div class="card-body text-muted">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                                accusamus terry richardson ad squid. 3 wolf moon officia
                                                                aute, non cupidatat skateboard dolor brunch. Food truck
                                                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                                sunt aliqua put a bird on it squid single-origin coffee
                                                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                helvetica, craft beer labore wes anderson cred nesciunt
                                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                                Leggings occaecat craft beer farm-to-table, raw denim
                                                                aesthetic synth nesciunt you probably haven't heard of them
                                                                accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white border-bottom-0 p-3" id="headingFour">
                                                            <h5 class="mb-0 mt-0 font-16 font-light">
                                                                <a href="#" class="text-white collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                    Q.4 When can be used?
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                                            <div class="card-body text-muted">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                                accusamus terry richardson ad squid. 3 wolf moon officia
                                                                aute, non cupidatat skateboard dolor brunch. Food truck
                                                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                                sunt aliqua put a bird on it squid single-origin coffee
                                                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                helvetica, craft beer labore wes anderson cred nesciunt
                                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                                Leggings occaecat craft beer farm-to-table, raw denim
                                                                aesthetic synth nesciunt you probably haven't heard of them
                                                                accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white border-bottom-0 p-3" role="tab" id="headingFive">
                                                            <h5 class="mb-0 mt-0 font-16 font-light">
                                                                <a href="#" class="text-white collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                                    Q.5 How many variations exist?
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                                            <div class="card-body text-muted">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                                accusamus terry richardson ad squid. 3 wolf moon officia
                                                                aute, non cupidatat skateboard dolor brunch. Food truck
                                                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                                sunt aliqua put a bird on it squid single-origin coffee
                                                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                helvetica, craft beer labore wes anderson cred nesciunt
                                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                                Leggings occaecat craft beer farm-to-table, raw denim
                                                                aesthetic synth nesciunt you probably haven't heard of them
                                                                accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white border-bottom-0 p-3" role="tab" id="headingSix">
                                                            <h5 class="mb-0 mt-0 font-16 font-light">
                                                                <a href="#" class="text-white collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                                    Q.6 License & Copyright
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                                            <div class="card-body text-muted">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                                accusamus terry richardson ad squid. 3 wolf moon officia
                                                                aute, non cupidatat skateboard dolor brunch. Food truck
                                                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                                sunt aliqua put a bird on it squid single-origin coffee
                                                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                                helvetica, craft beer labore wes anderson cred nesciunt
                                                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                                Leggings occaecat craft beer farm-to-table, raw denim
                                                                aesthetic synth nesciunt you probably haven't heard of them
                                                                accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h5>Can't find what you are looking for?</h5>
                                                <button type="button" class="btn btn-primary m-t-20 waves-effect waves-light">Email Us</button>
                                                <h6 class="text-muted m-t-20">OR</h6>

                                                <button type="button" class="btn btn-success m-t-10 waves-effect waves-light">Send us a tweet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <!-- Notification js -->
        <script src="assets/js/notification.js"></script>


    </body>
</html>
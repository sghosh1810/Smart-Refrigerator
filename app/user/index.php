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

<?php include('handlers/inventoryListHandler.php');?>

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

        <!--Chartist Chart CSS -->
        <link rel="stylesheet" href="../plugins/chartist/css/chartist.min.css">

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
                        <a href="index.php" class="logo"><img src="assets/images/logo-sm.png" height="36" alt="logo"></a>
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
                                <div class="col-md-6 col-xl-4">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-purple mr-0 float-right"><i class="mdi mdi-basket"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-purple"><?php echo $_SESSION['numberOfVariety'];?></span>
                                            Number of Variety
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class=" mb-0 m-t-20 text-muted">Number of items: <?php echo $_SESSION['numberOfItems'];?> </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-black-mesa"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-blue-grey">$<?php echo round(($_SESSION['totalPrice']/$_SESSION['numberOfItems']),2);?></span>
                                            Price on average
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class="text-muted mb-0 m-t-20">Total price: $<?php echo ($_SESSION['totalPrice']);?> </p>
                                    </div>
                                </div>
                                <!--
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
                                -->
                                <div class="col-md-6 col-xl-4">
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

                                <div class="col-xl-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">

                                            <h4 class="mt-0 header-title">Graph</h4>

                                            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                                <li class="list-inline-item">
                                                    <svg height="5" width="20">
                                                        <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(249,187,68);stroke-width:5" />
                                                    </svg>
                                                    <p class="text-muted font-14">Total Price</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <svg height="5" width="20">
                                                        <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(64,195,233);stroke-width:5" />
                                                    </svg>
                                                    <p class="text-muted font-14">Price Per Unit</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <svg height="5" width="20">
                                                        <line x1="0" y1="0" x2="200" y2="0" style="stroke:rgb(234,85,61);stroke-width:5" />
                                                    </svg>
                                                    <p class="text-muted font-14">Quantity</p>
                                                </li>
                                            </ul>

                                            <div id="smil-animations" class="ct-chart ct-golden-section"></div>

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

        <!--Chartist Chart-->
        <script src="../plugins/chartist/js/chartist.min.js"></script>
        <script src="../plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>

        <!--Inline Chart Js-->
        <script type="text/javascript">
            var chart = new Chartist.Line('#smil-animations', {
            labels: <?php echo json_encode($_SESSION['itemNamesArray']);?>,
            series: [
                [],
                <?php echo json_encode($_SESSION['itemTotalPriceArray']);?>,
                <?php echo json_encode($_SESSION['itemPriceArray']);?>,
                <?php echo json_encode($_SESSION['itemQuantityArray']);?>
            ]
            }, {
            low: 0,
            plugins: [
                Chartist.plugins.tooltip()
            ]
            });

            // Let's put a sequence number aside so we can use it in the event callbacks
            var seq = 0,
            delays = 80,
            durations = 500;

            // Once the chart is fully created we reset the sequence
            chart.on('created', function() {
            seq = 0;
            });

            // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
            chart.on('draw', function(data) {
            seq++;

            if(data.type === 'line') {
                // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
                data.element.animate({
                opacity: {
                    // The delay when we like to start the animation
                    begin: seq * delays + 1000,
                    // Duration of the animation
                    dur: durations,
                    // The value where the animation should start
                    from: 0,
                    // The value where it should end
                    to: 1
                }
                });
            } else if(data.type === 'label' && data.axis === 'x') {
                data.element.animate({
                y: {
                    begin: seq * delays,
                    dur: durations,
                    from: data.y + 100,
                    to: data.y,
                    // We can specify an easing function from Chartist.Svg.Easing
                    easing: 'easeOutQuart'
                }
                });
            } else if(data.type === 'label' && data.axis === 'y') {
                data.element.animate({
                x: {
                    begin: seq * delays,
                    dur: durations,
                    from: data.x - 100,
                    to: data.x,
                    easing: 'easeOutQuart'
                }
                });
            } else if(data.type === 'point') {
                data.element.animate({
                x1: {
                    begin: seq * delays,
                    dur: durations,
                    from: data.x - 10,
                    to: data.x,
                    easing: 'easeOutQuart'
                },
                x2: {
                    begin: seq * delays,
                    dur: durations,
                    from: data.x - 10,
                    to: data.x,
                    easing: 'easeOutQuart'
                },
                opacity: {
                    begin: seq * delays,
                    dur: durations,
                    from: 0,
                    to: 1,
                    easing: 'easeOutQuart'
                }
                });
            } else if(data.type === 'grid') {
                // Using data.axis we get x or y which we can use to construct our animation definition objects
                var pos1Animation = {
                begin: seq * delays,
                dur: durations,
                from: data[data.axis.units.pos + '1'] - 30,
                to: data[data.axis.units.pos + '1'],
                easing: 'easeOutQuart'
                };

                var pos2Animation = {
                begin: seq * delays,
                dur: durations,
                from: data[data.axis.units.pos + '2'] - 100,
                to: data[data.axis.units.pos + '2'],
                easing: 'easeOutQuart'
                };

                var animations = {};
                animations[data.axis.units.pos + '1'] = pos1Animation;
                animations[data.axis.units.pos + '2'] = pos2Animation;
                animations['opacity'] = {
                begin: seq * delays,
                dur: durations,
                from: 0,
                to: 1,
                easing: 'easeOutQuart'
                };

                data.element.animate(animations);
            }
            });

            // For the sake of the example we update the chart every time it's created with a delay of 10 seconds
            chart.on('created', function() {
            if(window.__exampleAnimateTimeout) {
                clearTimeout(window.__exampleAnimateTimeout);
                window.__exampleAnimateTimeout = null;
            }
            window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
            });



            //Simple line chart
            new Chartist.Line('#simple-line-chart', {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            series: [
                [12, 9, 7, 8, 5],
                [2, 1, 3.5, 7, 3],
                [1, 3, 4, 5, 6]
            ]
            }, {
            fullWidth: true,
            chartPadding: {
                right: 40
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
            });




            //Line Scatter Diagram
            var times = function(n) {
            return Array.apply(null, new Array(n));
            };

            var data = times(52).map(Math.random).reduce(function(data, rnd, index) {
            data.labels.push(index + 1);
            data.series.forEach(function(series) {
                series.push(Math.random() * 100)
            });

            return data;
            }, {
            labels: [],
            series: times(4).map(function() { return new Array() })
            });

            var options = {
            showLine: false,
            axisX: {
                labelInterpolationFnc: function(value, index) {
                return index % 13 === 0 ? 'W' + value : null;
                }
            }
            };

            var responsiveOptions = [
            ['screen and (min-width: 640px)', {
                axisX: {
                labelInterpolationFnc: function(value, index) {
                    return index % 4 === 0 ? 'W' + value : null;
                }
                }
            }]
            ];

            new Chartist.Line('#scatter-diagram', data, options, responsiveOptions);



            //Line chart with area

            new Chartist.Line('#chart-with-area', {
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4]
            ]
            }, {
            low: 0,
            showArea: true,
            plugins: [
                Chartist.plugins.tooltip()
            ]
            });


            //Overlapping bars on mobile

            var data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
            ]
            };

            var options = {
            seriesBarDistance: 10
            };

            var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                labelInterpolationFnc: function (value) {
                    return value[0];
                }
                }
            }]
            ];

            new Chartist.Bar('#overlapping-bars', data, options, responsiveOptions);




            //Stacked bar chart

            new Chartist.Bar('#stacked-bar-chart', {
            labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6'],
            series: [
                [800000, 1200000, 1400000, 1300000, 1520000, 1400000],
                [200000, 400000, 500000, 300000, 452000, 500000],
                [160000, 290000, 410000, 600000, 588000, 410000]
            ]
            }, {
            stackBars: true,
            axisY: {
                labelInterpolationFnc: function(value) {
                return (value / 1000) + 'k';
                }
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
            }).on('draw', function(data) {
            if(data.type === 'bar') {
                data.element.attr({
                style: 'stroke-width: 30px'
                });
            }
            });





            //Animating a Donut with Svg.animate

            var chart = new Chartist.Pie('#animating-donut', {
            series: [10, 20, 50, 20, 5, 50, 15],
            labels: [1, 2, 3, 4, 5, 6, 7]
            }, {
            donut: true,
            showLabel: false,
            plugins: [
                Chartist.plugins.tooltip()
            ]
            });

            chart.on('draw', function(data) {
            if(data.type === 'slice') {
                // Get the total path length in order to use for dash array animation
                var pathLength = data.element._node.getTotalLength();

                // Set a dasharray that matches the path length as prerequisite to animate dashoffset
                data.element.attr({
                'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
                });

                // Create animation definition while also assigning an ID to the animation for later sync usage
                var animationDefinition = {
                'stroke-dashoffset': {
                    id: 'anim' + data.index,
                    dur: 1000,
                    from: -pathLength + 'px',
                    to:  '0px',
                    easing: Chartist.Svg.Easing.easeOutQuint,
                    // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
                    fill: 'freeze'
                }
                };

                // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
                if(data.index !== 0) {
                animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                }

                // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us
                data.element.attr({
                'stroke-dashoffset': -pathLength + 'px'
                });

                // We can't use guided mode as the animations need to rely on setting begin manually
                // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
                data.element.animate(animationDefinition, false);
            }
            });

            // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
            chart.on('created', function() {
            if(window.__anim21278907124) {
                clearTimeout(window.__anim21278907124);
                window.__anim21278907124 = null;
            }
            window.__anim21278907124 = setTimeout(chart.update.bind(chart), 10000);
            });




            //Simple pie chart

            var data = {
            series: [5, 3, 4]
            };

            var sum = function(a, b) { return a + b };

            new Chartist.Pie('#simple-pie', data, {
            labelInterpolationFnc: function(value) {
                return Math.round(value / data.series.reduce(sum) * 100) + '%';
            }
            });


        </script>

        <!-- Page specific js -->
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <!-- IP js -->
        <script src="assets/js/ip.js"></script>


    </body>
</html>
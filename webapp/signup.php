<?php include('handlers/signupHandler.php') ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Dashboard Sign Up</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

        <style>
            html {
                overflow: hidden;
            }
        </style>

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>


        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0" align="center">
                        <a href="signup.php" class="logo logo-admin"><img src="assets/images/logo.png" height="25" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-dark font-18 m-b-5 text-center">Sign Up</h4>
                        <p class="text-muted text-center">Get your free Refrigerg account now.</p>

                        <form method="post" class="form-horizontal m-t-30" action="signup.php">
                            <?php include('handlers/errorHandler.php'); ?>
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" class="form-control" id="useremail" placeholder="Enter email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="userpassword" placeholder="Enter password" name="password_1">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Confirm Password</label>
                                <input type="text" class="form-control" id="userpassword" placeholder="Enter password" name="password_2">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="reg_user">Sign up</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20" align="center">
                                    <p class="text-white">Already have an account ?<a href="login.php" class="font-500 font-14 text-white font-secondary"> Login Here</a> </p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center"> 
                <p class="text-white">© 2020 Refrigerg. Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://github.com/sghosh1810" class="font-500 font-14 text-white font-secondary">Me</a></p>
            </div>

        </div>


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

    </body>
</html>
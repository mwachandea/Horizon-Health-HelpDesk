<?php
include 'init.php';
if ($users->isLoggedIn()) {
    header("location: index.php");
}
$errorMessage = $users->login();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="author" content="Alexander Mwachande">
    <meta name="description" content="Horizon Health Insurance Company HelpDesk">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/img/Horizon-Health2.png">
    <title>Login - Horizon-Health</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/FAQ%20buttons.css">
    <link rel="stylesheet" href="assets/css/Footer.css">
    <link rel="stylesheet" href="assets/css/Header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
</head>

<body class="bg-gradient-primary">
    <!-- Start: Header -->
    <div id="navigation-block">
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-family: Bungee, cursive;color: rgb(17,127,207);" href="index.php"><img class="img-fluid" src="assets/img/Horizon-Health2.png" style="width: 100%;min-width: 60px;" /></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="inquiry.php">Open/View Inquiry</a></li>
                        <li class="nav-item"><a class="nav-link" href="location.php">Hospital Location</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- End: Header -->
    
    <!-- Login -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image"><img class="img-fluid" src="assets/img/peace.jpeg" style="margin-top: 5%; margin-bottom: 5%; margin-left: 2%;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <?php if ($errorMessage != '') { ?>
                                    <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>
                                    <?php } ?>
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-dark mb-4">Please login to access your inquiries</p>
                                    </div>
                                    <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                                        <div class="form-group">
                                            <!-- Start: email --><input class="form-control form-control-user" type="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>">
                                            <!-- End: email -->
                                        </div>
                                        <div class="form-group">
                                            <!-- Start: password --><input class="form-control form-control-user" type="password" id="password" placeholder="Password" name="password">
                                            <!-- End: password -->
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox big">
                                                <div class="form-check"><input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["loginId"])) { ?> checked <?php } ?>> <label class="" for="remember">Remember Me</label></div>
                                            </div>
                                        </div>
                                        <div style="margin-top:10px" class="form-group">
                                            <div class="col-sm-12 controls">
                                                <input type="submit" name="login" value="Login" class="btn btn-primary btn-block text-white btn-user">
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.php">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start: Footer -->
    <DIV CLASS="CONTAINER">
        <footer>
            <div class="row">
                <div class="col-sm-6 col-md-4 footer-navigation">
                    <h3><a href="#">Horizon Health</a></h3>
                    <p class="links"><a href="index.php">Home</a><strong> ·&nbsp;</strong><a href="contact.php">Contact</a><strong> · </strong><a href="faq.php">FAQ</a><strong> · </strong><a href="location.php">Location</a></p>
                    <p class="company-name" style="color: rgb(0,0,0);">Copyright © 2021 Horizon Health - All rights reserved.<br></p>
                </div>
                <div class="col-sm-6 col-md-4 footer-contacts">
                    <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                        <p><span class="new-line-span">3rd Floor</span><span class="new-line-span">Chayamba Building</span> Blantyre, Malawi</p>
                    </div>
                    <div><i class="fa fa-phone footer-contacts-icon"></i>
                        <p class="footer-center-info email text-left"> +265 1 831 129</p>
                    </div>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p> <a href="contact.php" target="_blank" style="color: rgb(255,255,255);">support@horizonhealthmw.com</a></p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 footer-about">
                    <h4>The company</h4>
                    <p style="color: rgb(255,255,255);"> Horizon Health LTD. is a Health/Medical Insurance company. Every responsible Malawian needs to have medical insurance. It starts with Horizon Heath!</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- End: Footer -->
    
    <script src="js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/FAQ.js"></script>
</body>

</html>

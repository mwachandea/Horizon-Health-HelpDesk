<?php
include 'init.php';
if ($users->isLoggedIn()) {
    header("location: index.php");
}
$errorMessage = $users->registerUser();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="author" content="Alexander Mwachande">
    <meta name="description" content="Horizon Health Insurance Company HelpDesk">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/img/Horizon-Health2.png">
    <title>Register - Horizon Health</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
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

<body>
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
    
    <!-- Register Client -->
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"><img class="img-fluid" src="assets/img/register.jpg" style="margin-top: 15%;margin-left: 2%;"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create Your Account!</h4>
                                <p class="text-center">Please fill all information to create an account:</p>
                            </div>
                            <form id="registerform" class="form-horizontal" role="form" method="POST" action="">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label>First Name</label>
                                        <!-- Start: txtFirstName --><input class="form-control form-control-user" type="text" id="firstname" placeholder="First Name" name="firstname">
                                        <!-- End: txtFirstName -->
                                    </div>
                                    <div class="col-sm-6"><label>Surname</label>
                                        <!-- Start: txtSurname --><input class="form-control form-control-user" type="text" id="Surname" placeholder="Last Name" name="surname">
                                        <!-- End: txtSurname -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label>Email</label>
                                        <!-- Start: txtEmail --><input class="form-control form-control-user" type="email" id="Email" aria-describedby="emailInput" placeholder="Email Address" name="email">
                                        <!-- End: txtEmail -->
                                    </div>
                                    <div class="col-sm-6"><label>Date of Birth</label>
                                        <!-- Start: Dob --><input class="form-control form-control-user" id="dob" placeholder="dob" name="dob" type="date">
                                        <!-- End: Dob -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label>Password</label>
                                        <!-- Start: txtPassword --><input class="form-control form-control-user" type="password" id="Password" placeholder="Password" name="password">
                                        <!-- End: txtPassword -->
                                    </div>
                                    <div class="col-sm-6"><label>Confirm Password</label>
                                        <!-- Start: txtConfirmPassword --><input class="form-control form-control-user" type="password" id="ConfirmPassword" placeholder="Confirm Password" name="password_confirm">
                                        <!-- End: txtConfirmPassword -->
                                    </div>
                                </div>
                                <input type="submit" name="register_btn" value="Register Account" class="btn btn-primary btn-block text-white btn-user">
                                <hr>
                            </form>
                            <div class="text-center"></div>
                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
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
                    <p class="links"><a href="index.php">Home</a><strong> ??&nbsp;</strong><a href="contact.php">Contact</a><strong> ?? </strong><a href="faq.php">FAQ</a><strong> ?? </strong><a href="location.php">Location</a></p>
                    <p class="company-name" style="color: rgb(0,0,0);">Copyright ?? 2021 Horizon Health - All rights reserved.<br></p>
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

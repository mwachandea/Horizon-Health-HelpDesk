<?php
include 'init.php';
$user = $users->getUserInfo();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="author" content="Alexander Mwachande">
    <meta name="description" content="Horizon Health Insurance Company HelpDesk">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/img/Horizon-Health2.png">
    <title>Horizon Health</title>
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
    <link rel="stylesheet" href="assets/css/Image-Slider.css">
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
                        <?php if (isset($_SESSION['userid'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="inquiry.php">Dashboard</a></li>
                        <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="inquiry.php">Open/View Inquiry</a></li>
                        <?php } ?>
                        <li class="nav-item"><a class="nav-link" href="location.php">Hospital Location</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                        <?php if (isset($_SESSION['admin'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="hospital_register.php">Register Hospital</a></li>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if (isset($_SESSION['admin']) && isset($_SESSION['full'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="staff_register.php">SignUp Staff</a></li>
                        <?php } else { ?>
                        <?php } ?>
                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <?php if (isset($_SESSION['userid'])) { ?>
                        <li class="dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown"><span class="label label-pill label-danger count"></span>
                                <img src="//gravatar.com/avatar/<?php echo md5($user['email']); ?>?s=100" width="40px">&nbsp;<?php if (isset($_SESSION["userid"])) {
                                echo $user['firstname'];
                            } ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="profile.php">Account</a></li>
                                <li><a class="nav-link" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Sign Up</a></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- End: Header -->
    
    <!-- Intro -->
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"><img class="img-fluid" src="assets/img/tick.jpeg" style="margin-top: 1%;margin-left: 2%;width: 100%;"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h2 class="text-dark mb-2">Welcome to Horizon Health LTD</h2>
                                <h2 class="text-dark mb-2"> HelpDesk</h2>
                                <br>
                                <div class="text-left">
                                    <p>Horizon Health is a health insurance company. The company is Malawian based company which caters for its clients to hospitals all around the country and international. Horizon Health Limited is a locally registered company which started its operations on 1st July 2010.
                                        <br><br>
                                        Horizon provides affordable healthcare solutions while maximizing the benefits of the client. It supplies care and support with No Shortfalls, Countrywide Hospital Coverage, Affordable Premiums, Funeral Cover and No waiting period for Corporate. We make sure you that access to quality health services is no longer a problem for you and your family.
                                        <br><br>
                                        Click <a href="assets/BROCHURE.pdf" download>Here</a> to download our brochure
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Slide -->
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-2 d-none d-lg-flex">
                    </div>
                    <div class="col-lg-8">
                        <div id="post_carousel" class="carousel slide animate_text post_carousel_wrapper swipe_x ps_easeOutCirc" data-ride="carousel" data-duration="2000" data-interval="5000" data-pause="hover">
                            <ol class="carousel-indicators post_carousel_indicators">
                                <li data-target="#post_carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#post_carousel" data-slide-to="1"></li>
                                <li data-target="#post_carousel" data-slide-to="2"></li>
                                <li data-target="#post_carousel" data-slide-to="3"></li>
                                <li data-target="#post_carousel" data-slide-to="4"></li>
                                <li data-target="#post_carousel" data-slide-to="5"></li>
                                <li data-target="#post_carousel" data-slide-to="6"></li>
                                <li data-target="#post_carousel" data-slide-to="7"></li>
                                <li data-target="#post_carousel" data-slide-to="8"></li>
                                <li data-target="#post_carousel" data-slide-to="9"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active"><img src="assets/img/index/1.jpg" alt="post slide 01" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/2.jpg" alt="post slide 02" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/3.jpg" alt="post slide 03" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/4.jpg" alt="post slide 04" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/5.jpg" alt="post slide 05" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/6.jpg" alt="post slide 06" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/7.jpg" alt="post slide 07" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/8.jpg" alt="post slide 08" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/9.jpg" alt="post slide 09" />
                                </div>
                                <div class="carousel-item"><img src="assets/img/index/10.jpg" alt="post slide 10" />
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#post_carousel" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous
                                </span></a>
                            <a class="carousel-control-next" href="#post_carousel" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">
                                    Next
                                </span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Schemes -->
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <section id="schemes" style="padding: 2px;margin: 11px;">
                            <h2 class="text-uppercase text-center" style="font-size: 48;">Medical Schemes</h2>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <div class="p-5">
                            <div class="text-center">
                                <div><img src="assets/img/thaplus.jpg" alt="THANDIZO PLUS Picture" style="margin-top: 1%;margin-left: 2%;width: 110%;" /></div>
                                <br>
                                <h3 class="text-dark mb-2">THANDIZO</h3>
                                <br>
                                <div class="text-left">
                                    <p>Affordable Premiums, with access to better health services and good, free funeral plan. Not breaking you bank as you protect your health.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="p-5">
                            <div class="text-center">
                                <div><img src="assets/img/umoyo.jpg" alt="UMOYO Picture" style="margin-top: 1%;margin-left: 2%;width: 110%;" /></div>
                                <br>
                                <h3 class="text-dark mb-2">UMOYO</h3>
                                <br>
                                <div class="text-left">
                                    <p>With an overall annual limit of over 4 million Kwacha and access to all approved private clinics.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="p-5">
                            <div class="text-center">
                                <div><img src="assets/img/ufulu2.jpg" alt="UFULU picture" style="margin-top: 1%;margin-left: 2%;width: 110%;" /></div>
                                <br>
                                <h3 class="text-dark mb-2">UFULU</h3>
                                <br>
                                <div class="text-left">
                                    <p>Gives you an overall annual limit of over 7 million Kwacha and access to all private clinics and hospitals</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="p-5">
                            <div class="text-center">
                                <div><img src="assets/img/family.jpg" alt="family picture" style="margin-top: 1%;margin-left: 2%;width: 110%;" /></div>
                                <br>
                                <h3 class="text-dark mb-2">MTENDERE</h3>
                                <br>
                                <div class="text-left">
                                    <p>With an overall annual limit of over 15 million Kwacha and access to all approved private clinics and hospitals. Offering you perfect peace you deserve.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start: Footer -->
    <div class="container">
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
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
</body>

</html>

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
    <title>FAQ - Horizon Health</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Footer.css">
    <link rel="stylesheet" href="assets/css/Header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/FAQ%20buttons.css">
    <!-- Floating CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style type="text/css">
        .label-container {
            position: fixed;
            bottom: 48px;
            right: 105px;
            display: table;
            visibility: hidden;
        }

        .label-text {
            color: #FFF;
            background: rgba(51, 51, 51, 0.5);
            display: table-cell;
            vertical-align: middle;
            padding: 10px;
            border-radius: 3px;
        }

        .label-arrow {
            display: table-cell;
            vertical-align: middle;
            color: black;
            opacity: 0.5;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #06C;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 0.5px 0.5px 1px #999;
        }

        .my-float {
            font-size: 24px;
            margin-top: 18px;
        }

        a.float+div.label-container {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.7s ease;
        }

        a.float:hover+div.label-container {
            visibility: visible;
            opacity: 1;
        }

    </style>
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
    
    <!-- FAQ buttons -->
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-2 d-none d-lg-flex">
                    </div>
                    <div class="col-lg-8">
                        <!-- Start: FAQ -->
                        <section id="faq" style="padding: 2px;margin: 11px;">
                            <h2 class="text-uppercase text-center" style="font-size: 48;">Frequently Asked Questions</h2>
                            <p class="text-center">You may find frequently asked questions below:</p>
                            <!-- Start: br --><br>
                            <!-- End: br -->
                            <div class="container">
                                <div class="faqelement"><button class="btn btn-primary faq on" type="button" style="box-shadow: none;">What is health insurance?&nbsp;</button>
                                    <div class="panel">
                                        <p>Health Insurance is a type of insurance that typically pays for medical, surgical, dental and other expenses incurred by the insured client.</p>
                                    </div>
                                </div>
                                <!-- Start: br --><br>
                                <!-- End: br -->
                                <div class="faqelement"><button class="btn btn-primary faq on" type="button" style="box-shadow: none;">What are the prices for a scheme?&nbsp;</button>
                                    <div class="panel">
                                        <p>Horizon Health offers up to 8 schemes for clients with various price ranges to meet all its clients: <br>
                                            Student Scheme: MK3,300 <br>
                                            Thandizo: MK5,600 <br>
                                            Thandizo Plus: MK9,300 <br>
                                            Umoyo: MK14,200 <br>
                                            Ufulu: MK24,700 <br>
                                            Ufulu Foreign Benefit: MK40,700 <br>
                                            Mtendere: MK69,500 <br>
                                            Makolo: MK45,200.
                                        </p>
                                    </div>
                                </div>
                                <!-- Start: br --><br>
                                <!-- End: br -->
                                <div class="faqelement"><button class="btn btn-primary faq on" type="button" style="box-shadow: none;">What are shortfall and What shortfalls are available?&nbsp;</button>
                                    <div class="panel">
                                        <p>Shortfalls are when the client has to pay at the hospital the remaining amount that the insurance company can offer for their given scheme. This is usually when a scheme has limit on amount it pays out for treatment or drugs, example, MK80,000 limit for optical for clients on Thandizo Plus. <br>
                                            Horizon Health has shortfalls only on chronic branded drugs and caesarean section cover. Which the company covers up to 70%.
                                        </p>
                                    </div>
                                </div>
                                <!-- Start: br --><br>
                                <!-- End: br -->
                                <div class="faqelement"><button class="btn btn-primary faq on" type="button" style="box-shadow: none;">Which hospital can a client visit?&nbsp;</button>
                                    <div class="panel">
                                        <p>Please visit the location page to see the major hospitals that covered by Horizon Health. <br> <br>
                                            Otherwise you can download the full list of hospitals for all schemes <a href="assets/Hospitallist.pdf" download>Here</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- Start: br --><br>
                                <!-- End: br -->
                                <div class="faqelement"><button class="btn btn-primary faq on" type="button" style="box-shadow: none;">What happens when I reach my limitation?&nbsp;</button>
                                    <div class="panel">
                                        <p>When one reaches their limits then it means there's no cover until the following year when a new annual limit is allocated(renewed)</p>
                                    </div>
                                </div>
                                <!-- Start: br --><br>
                                <!-- End: br -->
                                <div class="faqelement"><button class="btn btn-primary faq on" type="button" style="box-shadow: none;">What are the price differences for children?&nbsp;</button>
                                    <div class="panel">
                                        <p>There is no prices for children or handicap person. All prices are uniform.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End: FAQ -->
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
    
    <!-- Floating Button -->
    <a href="index.php" class="float">
        <i class="fa fa-home my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Home Page</div>
        <i class="fa fa-play label-arrow"></i>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/FAQ.js"></script>
</body>

</html>

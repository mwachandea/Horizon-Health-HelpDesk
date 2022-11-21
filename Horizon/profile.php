<?php
include 'init.php';
if (!$users->isLoggedIn()) {
header("Location: login.php");
}
$user = $users->getUserInfo();
$errorMessage = $users->updateUser();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="author" content="Alexander Mwachande">
    <meta name="description" content="Horizon Health Insurance Company HelpDesk">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/img/Horizon-Health2.png">
    <title><?php echo $user['email']; ?> - Horizon Health</title>
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
    
    <!-- Profile -->
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"><img class="img-fluid" src="assets/img/covered.jpg" style="margin-top: 15%;margin-left: 2%;"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <?php if ($errorMessage != '') { ?>
                            <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>
                            <?php } ?>
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Update Your Account!</h4>
                            </div>
                            <form id="updateform" class="form-horizontal" role="form" method="POST" action="">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label>First Name</label>
                                        <!-- Start: txtFirstName --><input class="form-control form-control-user" type="text" id="firstname" placeholder="First Name" name="firstname" value="<?php echo $user['firstname'] ?>">
                                        <!-- End: txtFirstName -->
                                    </div>
                                    <div class="col-sm-6"><label>Surname</label>
                                        <!-- Start: txtSurname --><input class="form-control form-control-user" type="text" id="surname" placeholder="Last Name" name="surname" value="<?php echo $user['surname'] ?>">
                                        <!-- End: txtSurname -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label>Email</label>
                                        <!-- Start: txtEmail --><input readonly class="form-control form-control-user" type="email" id="Email" aria-describedby="emailInput" placeholder="Email Address" name="email" value="<?php echo $user['email'] ?>">
                                        <!-- End: txtEmail -->
                                    </div>
                                    <div class="col-sm-6"><label>Date of Birth</label>
                                        <!-- Start: Dob --><input class="form-control form-control-user" id="dob" placeholder="First Name" name="dob" type="date" value="<?php echo $user['dob'] ?>">
                                        <!-- End: Dob -->
                                    </div>
                                </div>
                                <?php if (isset($_SESSION['admin'])) { ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label>Department</label>
                                        <!-- Start: sltDepartment -->
                                        <select id="department" name="department" class="form-control" placeholder="Department..." value="">
                                            <?php $tickets->getDepartments(); ?>
                                            <?php if ($_SESSION['dept'] == ['department']) { echo ' SELECTED'; } ?>
                                        </select>
                                        <!-- End: sltDepartment -->
                                    </div>
                                    <div class="col-sm-6"><label>Full Inquiry View</label>
                                        <div class="form-control form-control-user">
                                            <!-- Start: txtSurname --> <input type="checkbox" id="fullaccess" name="fullaccess" value="yes" <?php echo ($user['allowed'] == 1 ? 'checked' : ''); ?>> <label>View All Department Inquiries</label>
                                            <!-- End: txtSurname -->
                                        </div>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <?php } ?>
                                <input type="submit" name="update_btn" value="Update Account" class="btn btn-primary btn-block text-white btn-user">
                                <hr>
                            </form>
                            <div class="text-center"></div>
                            <div class="text-center"><a class="small" href="password.php">Change Password</a></div>
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
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
</body>

</html>

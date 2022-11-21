<?php
include 'init.php';
if (!$users->isLoggedIn()) {
header("Location: login.php");
}
$ticketDetails = $tickets->ticketInfo($_GET['id']);
$ticketReplies = $tickets->getTicketReplies($ticketDetails['id']);
$user = $users->getUserInfo();
$tickets->updateTicketReadStatus($ticketDetails['id']);
?>

<head>
    <meta name="author" content="Alexander Mwachande">
    <meta name="description" content="Horizon Health Insurance Company HelpDesk">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/img/Horizon-Health2.png">
    <title>Inquiry - Horizon Health</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Footer.css">
    <link rel="stylesheet" href="assets/css/Header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <script src="js/ajax.js"></script>

    <!-- Script to print the content of a div -->
    <script>
        function printDiv() {
            var topprint = document.getElementById("topprint").innerHTML;
            var inqprint = document.getElementById("replyprint").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Printing Inquiry<br>');
            a.document.write(topprint);
            a.document.write(inqprint);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }

    </script>

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
                        <li class="nav-item"><a class="nav-link" href="#" onclick="printDiv()">Print</a></li>
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

    <!-- Replies -->
    <div class="container">
        <section class="comment-list">
            <article class="row">
                <div id="topprint" class="col-md-10 col-sm-10">
                    <div class="panel panel-default arrow left">
                        <div class="panel-heading right">
                            <?php if ($ticketDetails['resolved']) { ?>
                            <button type="button" class="btn btn-danger btn-sm">
                                <span class="glyphicon glyphicon-eye-close"></span> Closed
                            </button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-eye-open"></span> Open
                            </button>
                            <?php } ?>
                            <span class="ticket-title"><?php echo $ticketDetails['title']; ?></span>
                        </div>
                        <div class="panel-body">
                            <div class="comment-post">
                                <p>
                                    <?php echo $ticketDetails['message']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="panel-heading right">
                            <span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($ticketDetails['date']); ?></time>
                            &nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span> <?php echo $ticketDetails['creator']; ?>
                            &nbsp;&nbsp;<span class="glyphicon glyphicon-briefcase"></span> <?php echo $ticketDetails['department']; ?>
                        </div>
                    </div>
                </div>
            </article>
            <br>
            <div id="replyprint">
                <?php foreach ($ticketReplies as $replies) { ?>
                <article class="row">
                    <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow right">
                            <div class="panel-heading">
                                <?php if ($replies['user_group'] == 1) { ?>
                                <span class="glyphicon glyphicon-user"></span><?php echo $replies['department'];
                    echo " ";
                    echo $replies['email']; ?>
                                <?php } else { ?>
                                <span class="glyphicon glyphicon-user"></span> <?php echo $replies['creator']; ?>
                                <?php } ?>
                                &nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($replies['date']); ?></time>
                            </div>
                            <div class="panel-body">
                                <div class="comment-post">
                                    <p>
                                        <?php echo $replies['message']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php } ?>
            </div>
            <form method="post" id="ticketReply">
                <article class="row">
                    <div class="col-md-10 col-sm-10">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="message" name="message" placeholder="Enter your reply..." required></textarea>
                        </div>
                    </div>
                </article>
                <article class="row">
                    <div class="col-md-10 col-sm-10">
                        <div class="form-group">
                            <input type="submit" name="reply" id="reply" class="btn btn-success" value="Reply" />
                        </div>
                    </div>
                </article>
                <input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />
                <input type="hidden" name="action" id="action" value="saveTicketReplies" />
            </form>
        </section>
        <?php include('add_ticket_model.php'); ?>
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

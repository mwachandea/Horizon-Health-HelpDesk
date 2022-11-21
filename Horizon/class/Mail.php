<?php
    //handles the emailing
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer\PHPMailer.php';
        require 'PHPMailer\Exception.php';
        require 'PHPMailer\SMTP.php';
        if(!empty($_POST["contact_btn"]) ) {
            $mail = new PHPMailer;
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            
            //runs gmail smtp using account:nacittest2021@gmail.com
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nacittest2021@gmail.com'; //email username
            $mail->Password = 'nacit2021'; //email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('nacittest2021@gmail.com', $email);
            $mail->addAddress('nacittest2021@gmail.com');
            $mail->Subject = 'Contact Us Email By '.$name.'.';
            $mail->isHTML(true);
            $mailContent = "Email From: ".$email." <br> By: ".$name." <br><br> Message: ".$message.".";
            $mail->Body = $mailContent;
            if(!$mail->send()){
                echo '<script>alert("Message could not be sent.\n")</script>';
                echo 'Message could not be sent';
                echo 'Mailer error '.$mail->ErrorInfo;
                header( "refresh:5;url=/Alexander_Mwachande_Horizon/contact.php" );
            } 
            else {
                echo '<script>alert("Message has been sent.\n")</script>';
                echo 'Message has been sent.';
                header( "refresh:0;url=/Alexander_Mwachande_Horizon/contact.php" );
            }
        }
        else if(!empty($_POST["contact_btn"])){
			echo "Please Make Sure Everything Is Filled Correctly!";	
		}
?>
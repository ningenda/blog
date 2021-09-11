<?php

$con=mysqli_connect('localhost','root','','blog');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';
$u=base64_decode($_REQUEST['userid']);# using this method you can access 
$q="select * from 
content where id='$u'"; 
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'samundrilootera18@gmail.com';                     //SMTP username
$mail->Password   = '@DubaraMTpuchhna';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->setFrom('samundrilootera18@gmail.com', 'Blog');
$mail->addAddress($row['email'],$row['author']);           // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

if($row['status']==1){
    $mail->Subject = 'Request Accepted';
    $mail->Body='<b style="color:green;">We are happy to inform you blog has been approved.</b>';
    }elseif($row['status']==0){
    $mail->Subject = 'Request denied';
    $mail->Body='<b style="color:green;">We regret to inform you that we cannot process your request at this time ,please send your details again on <a class="btn btn-lg btn-outline-warning" href="lisu.php">Sign in </a></b>';
    }
    elseif($row['status']==2){
        $mail->Subject = 'Request still not processed';
        $mail->Body='<b style="color:green;">We regret to inform that due to some unforeseen circumstances you request has still not been processes. We regret the inconvienced caused</b>';
        }
     if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
        
        header('Location:userpost.php');
        
        


?>             






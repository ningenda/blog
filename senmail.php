<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';



$mail = new PHPMailer;

$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'samundrilootera18@gmail.com';                     //SMTP username
$mail->Password   = '@DubaraMTpuchhna';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->setFrom('kingprashant251@gmail.com', 'OTP Verification');
$mail->addAddress('gaurav4universe@gmail.com', 'gaurav');           // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

$mail->Subject = 'OTP Verification';
$mail->Body    = 'Your verification OTP Code is <b>90909</b>';

if($mail->send()) {
    echo"okkk";
    die;
    //return true;
} else {
    echo "not okk";
    die;
    //return false;
}
    
  

?>
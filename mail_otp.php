<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';

function sendotp($username,$otp)
{
$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'samundrilootera18@gmail.com';                     //SMTP username
$mail->Password   = '@DubaraMTpuchhna';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->setFrom('samundrilootera18@gmail.com', 'Blog');
$mail->addAddress($username);           // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

$mail->Subject = 'OTP Verification';
$mail->Body    = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
$mail->send();
}
 ?>




             






<?php



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
$mail->setFrom('samundrilootera18@gmail.com', 'Blog');
$mail->addAddress($email, $name);           // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

$mail->Subject = 'Email Verification';
$mail->Body    = "Click here to verify your account <br>
<a href='http://localhost/php/examples/active.php?token=$token'><button class='btn btn-danger'>Verify</button></a>";

if($mail->send()) {
    echo $_SESSION['MSG']="Check Your Email to verify your account $email";
    header('location:lisu.php');
} else {
    echo $_SESSION['MSG']="you ";
   header('location:lisu.php');  
}
   //SMTP username  
//$mail->send();
//echo 'Message has been sent';
//} catch (Exception $e) {
// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 

?>             






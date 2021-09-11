<?php
session_start();
include("mail_otp.php");
$error_mesage='';
# form handling  
# how to take input from user and get it into php

date_default_timezone_set('Asia/kolkata');
$con=mysqli_connect('localhost','root','','blog'); # here we attach connection file using include function.

$msg='';
if(isset($_POST['signup'])){
  # how to get data from OUR FORM

  #$name=$_POST['name'];

  $name =mysqli_real_escape_string($con,$_POST['name']);
	$email =mysqli_real_escape_string($con, $_POST['email']);  
	$phone =mysqli_real_escape_string($con,($_POST['phone']));
  $token=bin2hex(random_bytes(15));
  
   $date=date('Y-M-d h:i:s');
   $query="select * from user where email='$email'";

   $result=mysqli_query($con,$query);

   if(mysqli_num_rows($result)>0){
      echo "email already exits";   

   }else{
       $insertquery="insert into user(name,email,phone,token,date)values('$name','$email','$phone','$token','$date')";
       $iquery=mysqli_query($con,$insertquery);  # this function helps to execute our query , where $con is connection variable and $q is our query string.
       if($iquery){
         include "sendmail.php";
      }else{
         echo 'Server Issue Occur,Try Again !';
      }
      
   }




}




?>
<?php


$success = "";
$error_message = "";
if(isset($_SESSION['loggedin']) || isset($_COOKIE['UID'])){
 header('location:dashboard.php');
}

  if(isset($_POST['getotp'])){
    
    $username=mysqli_real_escape_string($con,$_POST['username']);

    $q="select * from user where email='$username' and (status=1)";
    // echo $q;die;
    $r=mysqli_query($con,$q);
    $row=mysqli_fetch_assoc($r);  # thsi function helps to get our data from our query result set.
    // $_SESSION['loggedin']='1';
    // $_SESSION['sessdata']=$row;
    // // this is how you can set cookie in php
    // setcookie('UID',$row['id'],time()+60*60*24*30);  # here $r get total rows after executing sql query

    if(mysqli_num_rows($r)>0){  # here we check at least one user returned or not
      $otp=rand(100000,999999);
      $useremail=$row['email'];
      
      sendotp($username,$otp);
      $res = mysqli_query($con,"INSERT INTO otp_expiry(useremail,otp,is_expired,create_at) VALUES ('".$useremail."','" . $otp . "', 0, '" . date("Y-M-d H:i:s"). "')");
      $current_id = mysqli_insert_id($con);
      if(!empty($current_id)) {
        $success=1;
      } 
    }
       # this function helps to open new page
    else{

      $error_mesage="email doesnot exits!";
    }
  
  }
  if(isset($_POST["login"])) {

    $otp=$_POST["otp"];
   // $username2=$_POST["username2"];
    $q2="SELECT * FROM otp_expiry WHERE otp='$otp'  AND is_expired=0";
    // echo $q2;die;
    $resullt = mysqli_query($con,$q2);
  
    $count  = mysqli_num_rows($resullt);
    if(($count)>0) {

      $rows=mysqli_fetch_assoc($resullt);
      $email=$rows['useremail'];

      $qs="select * from user where email='$email'";
      $rs=mysqli_query($con,$qs);
      $rowdata=mysqli_fetch_assoc($rs);


      $result = mysqli_query($con,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
      $success = 2;	
      
    $_SESSION['loggedin']='1';
    $_SESSION['sessdata']=$rowdata;
    // this is how you can set cookie in php
    setcookie('UID',$rowdata['id'],time()+60*60*24*30);  # here $r get total rows after executing sql query




    } else {
      $success =1;
      $error_message = "Invalid OTP!";
    }	
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="csss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
           <?php $msg='';?>
            <form method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa fa-google"></i></a>
                    <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="name" id="name" placeholder="Enter your name" required>
                  
    	        <input type="email" name="email" id="email" placeholder="Enter Email" required>
    	    
    	        <input type="number" name="phone" id="phone" placeholder="Enter phone" required>
              <!--   <input type="submit" name="signup" id="signup" value="Signup">-->
                <button type="submit" name="signup" id="signup">signup</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
              <?php
		             if(!empty($error_message)){
	             ?>
             	<div class="btn btn-dander"><?php echo $error_message; ?></div>
             	<?php
             		}
             	?>
                <span style="color:red;"><?php echo $msg;  ?></span>
            <form method="post">
            <input type="hidden" name="username2" id="username2">
            <?php 
			         if(!empty($success == 1)){ 
		        ?>
                <h1>OTP</h1>
                 <span> write down otp</span>
                 
                <input type="number" name="otp" id="otp" placeholder="Enter Your OTP " required>
                <button type="submit" name="login" id="login">Login</button>
            <?php 
			        } elseif($success == 2) {
            ?>
	        	<p style="color:#31ab00;">Welcome, You have successfully loggedin!</p>
            <?php
            //session   this will store your data for further use

                 header('location:dashboard.php');
	                 
			      }
			     else {
		      ?>
              <div>
                <p>
                <?php
                     if(isset($_SESSION['MSG'])){
                       echo $_SESSION['MSG'];
                     }else{
                      echo $_SESSION['MSG']="you ";
                     }
                  ?>
                </p>
              </div>
                <h1>Sign in</h1>
              <!--  <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa fa-google"></i></a>
                    <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                </div>-->
                <span> use your email</span>
                <?php
                 echo $error_mesage;
                ?>
                <input type="email" name="username" id="username" placeholder="Enter Your Email" required onkeyup="copyemail()">
                <button type="submit" name="getotp" id="getotp">GET OTP</button>
            <?php 
		        	}
		        ?> 
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="jss.js"></script>
    <script>
      function copyemail(){
        c=document.getElementById('username').value;
        document.getElementById('username2').value=c;
      }
    </script>
</body>
</html>
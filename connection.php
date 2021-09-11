<?php
session_start();
date_default_timezone_set('Asia/kolkata');
$con=mysqli_connect('localhost','root','','blog');

if(!isset($_COOKIE['UID'])){
  header('Location:lisu.php');
}
if(!isset($_SESSION['loggedin'])){
      
       $uid=$_COOKIE['UID'];
       $q="select * from user where id='$uid'";
       $r=mysqli_query($con,$q);
       $row=mysqli_fetch_assoc($r);
       $_SESSION['loggedin']=1;
       $_SESSION['sessdata']=$row;
       setcookie('UID',$row['id'],time()+60*60*24*30);
}
?>
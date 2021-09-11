<?php
$con=mysqli_connect('localhost','root','','blog');
   $u=base64_decode($_REQUEST['userid']);# using this method you can access 
   $q="delete from user where id='$u'";
   $r=mysqli_query($con,$q);

   header('Location:users.php');
   ?>
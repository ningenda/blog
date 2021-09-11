<?php
session_start();
$con=mysqli_connect('localhost','root','','blog');
if(isset($_GET['token'])){
    $token=$_GET['token'];
    $updatequery="update user set status=1 where token='$token'";
    $query=mysqli_query($con,$updatequery);
    if($query){
        if(isset($_SESSION['MSG'])){
            $_SESSION['MSG']="Acount  updated succesfully";
            header('location:lisu.php');
        }else{
            $_SESSION['MSG']="you are loged out";
            header('location:lisu.php');   
        }
    }else{
        $_SESSION['MSG']="Account not updated ";
        header('location:lisu.php'); 
    }
}

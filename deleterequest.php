<?php
    $con=mysqli_connect('localhost','root','','blog');
   $u=base64_decode($_REQUEST['userid']);# using this method you can access 
    $sql="select * from content where id='$u'";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($query);
    $x=$row['authorid'];
    $s="select * from user where id='$x'";
    $q=mysqli_query($con,$s);
    $r=mysqli_fetch_assoc($q);
    $created=$r['postcreated']-1;
    $left=$r['postleft']+1;
    $sql2=" UPDATE user SET postcreated='$created',postleft='$left' WHERE id='$x'";
    $query=mysqli_query($con,$sql2);

   $q="delete from content where id='$u'";
   $r=mysqli_query($con,$q);

  

   header('Location:userpost.php');

?>
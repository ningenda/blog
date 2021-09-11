<?php
include "header.php";
$con=mysqli_connect('localhost','root','','blog');
if(isset($_POST['update'])){
    $uid=$_POST['userid2'];
    $status=$_POST['status'];
    $up="update content set status='$status' where id='$uid'";
    echo $up;
    $update=mysqli_query($con,$up);
    if(mysqli_affected_rows($con)){
      $msg='Account Updated Successfully';
    }else{
      $msg='Error occured';
    }
  
  $u=base64_decode($_REQUEST['userid']);
  $q="select * from content where id='$u'";
  $r=mysqli_query($con,$q);
  $row=mysqli_fetch_assoc($r);
  }else{
    $msg='';
   $u=base64_decode($_REQUEST['userid']);# using this method you can access 
   $q="select * from 
   content where id='$u'";
   $r=mysqli_query($con,$q);
   $row=mysqli_fetch_assoc($r);
   
   }
  ?>
  <div class="container   ">
  <h2 class="text-warning">Process booking</h2>
  <h3 style="color:green;"><?php  echo $msg; ?></h3>
  <form class="bg-light text-dark text-center" method="post" enctype="multipart/form-data" action=""    >
                  <fieldset>
                  
                  <input type="hidden" value="<?php echo $row['id']?>" name="userid2">
                  <label for="inputName" class="sr-only">Name</label>
                  <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" value="<?php echo $row['title']?>"required>
                  <br>
                    <label for="inputEmail" class="sr-only book text-light">Email</label>
                  <input type="email" id="inputEmail" name="user" class="form-control mb-2" placeholder="Email address" value="<?php echo $row['author']?>"required autofocus disabled>
                  <br>
                  <label for="inputmanufacturer" class="sr-only book">Make and Model</label>
                  <input type="text" id="inputEmail" name="user" class="form-control mb-2" placeholder="Make" value="<?php echo $row['added_date']?>"required autofocus disabled>
                  <br>
         
                  <label for="inputmodel" class="sr-only book">Bike Number</label>
                  <input type="text" id="inputEmail" name="user" class="form-control mb-2" placeholder="model" value="<?php echo $row['category']?>"required autofocus disabled>
                  <br>
                  <label for="inputtime" class="sr-only book">Time Slot</label>
                  <td><a href="./user.php?userid=<?php echo base64_encode($row['id']);?>" class="btn btn-primary">Read</a></td>
                  <br>
                  <label for="inputStatus" class="sr-only">Status</label>
                  <select name="status" class="form-control text-dark">
                  <?php 
                 if($row['status']==1){
                ?>
                <option value="1" selected class="text-light">Active</option>
                <option value="0">Pending</option>
                <option value="2">Reject</option>
                <?php
                 }elseif($row['status']==2){
                 ?>
                 <option value="2"selected>Reject</option>
                 <option value="1" >Active</option>
                 <option value="0" >Pending</option>
                 <?php 
                  }else{
                  ?>
                  <option value="0"selected>Pending</option>
                 <option value="1" >Active</option>
                 <option value="2" >Reject</option>
                    <?php
                  }
                    ?>
                  </select>
                  <br>
                  <button class="btn btn-lg btn-outline-warning"  htype="submit" name="update">Update</button><br>
                  <p>Please confirm the details then</p>
                  <a class="btn btn-lg btn-outline-warning" href="postconf.php?userid=<?php echo base64_encode($row['id']) ?>">Confirm</a>
                  <br>
                  </div>
                  <br>
                  <br>
                  <br>
  <?php

include "footer.php";
?>
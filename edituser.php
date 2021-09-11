<?php
include "header.php";
$con=mysqli_connect('localhost','root','','blog');
if(isset($_POST['update'])){
    $uid=$_POST['userid2'];
    $status=$_POST['status'];
    $up="update user set status='$status' where id='$uid'";
    echo $up;
    $update=mysqli_query($con,$up);
    if(mysqli_affected_rows($con)){
      $msg='Account Updated Successfully';
    }else{
      $msg='Error occured';
    }
  
  $u=base64_decode($_REQUEST['userid']);
  $q="select * from user where id='$u'";
  $r=mysqli_query($con,$q);
  $row=mysqli_fetch_assoc($r);
  }else{
    $msg='';
   $u=base64_decode($_REQUEST['userid']);# using this method you can access 
   $q="select * from 
   user where id='$u'";
   $r=mysqli_query($con,$q);
   $row=mysqli_fetch_assoc($r);
   
   }
   ?>
   <div class="container">
<h2 class="text-warning"> Edit Users</h2>

<h3 style="color:green;"><?php  echo $msg; ?></h3>
<form class="bg-light text-dark text-center" method="post" enctype="multipart/form-data" action=""    >
                <fieldset>
                
                <input type="hidden" value="<?php echo $row['id']?>" name="userid2">
                <label for="inputName" class="sr-only">Name</label>
                <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" value="<?php echo $row['name']?>"required>
                <br>
                  <label for="inputEmail" class="sr-only book">Email</label>
                <input type="email" id="inputEmail" name="user" class="form-control mb-2" placeholder="Email address" value="<?php echo $row['email']?>"required autofocus disabled>
                <br>
                <label for="inputStatus" class="sr-only">Status</label>
                <select name="status" class="form-control">
                <?php 
               if($row['status']==1){
              ?>
              <option value="1" selected>Active</option>
              <option value="0">Suspend</option>
              <?php
               }else{
               ?>
               <option value="0"selected>Suspend</option>
               <option value="1" >Active</option>
               <?php 
                }
                ?>
                </select>
                <br>
                <button class="btn btn-lg btn-outline-warning" type="submit" name="update">Update</button>
                <br>
                </div>
                <br>
                <br>
                <br>
<?php
include "footer.php";

?>
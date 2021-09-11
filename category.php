<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
include "header.php";
$msg='';
if(isset($_POST['submit'])){
  $c=$_POST['category'];
  $q="insert into category(category)values('$c')";
  if($r=mysqli_query($con,$q)){
     $msg="category created successfully";
  }else{
    $msg="plese try again";
  }
}
/*fetching our top project
$sql="select * from content";
$m=mysqli_query($con,$sql);
//fetching category
$q="select * from category";
$r=mysqli_query($con,$q);*/
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
          <div class="card card-upgrade">
              <div class="card-header text-center">
                <h4 class="card-title">CREATE CATEGORY</h3>
              </div>
              <div class="card-body">
                   <form method="post">
                     <h1><?php echo $msg ?></h1>
                   <br>
                     <input type="text" name="category" id="category" placeholder="enter category name" class="form-control">
                     <br>
                     <input type="submit" name="submit" value="submit" class="btn btn-primary" >
                   </form>
              </div>
            </div>
          </div>
        </div>
      </div>
 <?php  include "footer.php"?>
<?php
include "welcome-header.php";
$u=base64_decode($_REQUEST['userid']);# using this method you can access 

$q="select * from content where id='$u'";
$r=mysqli_query($con,$q);

$sql="select * from content";
$m=mysqli_query($con,$sql);
?>
    <div class="container">
    <div class="row">
    <?php 
    while($row=mysqli_fetch_assoc($r)){
 ?>
        <div class="col-lg-12 col-md-12 mb-4">

          <div class="card">
                 <div>
                   <span class="spn">category:<?php echo $row['category'];?></span> 
                   <br> 
                   <span class="spn">DATE:<?php echo $row['added_date'];?></span>    
                   <br>
                   <span class="spn">AUTHOR NAME:<?php echo $row['author'];?></span>
                  
                 </div>
                  <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="upload/<?php echo $row['photo'];?>" class="img-fluid pic" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title title"><?php echo $row['title'];?></h5>
                    <p class="card-text ">
                        <div class="mycontent">
                           <?php echo $row['content'];?>  
                        </div>
                    </p>
                  </div>
            </div>
        </div>
        <?php
        }
        ?>
      </div> 
      </div>
      
 <?php include "welcome-footer.php";
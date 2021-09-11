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

<?php include "header.php"; 


$r=mysqli_query($con,$sql);



?>
      
      <!-- End Navbar -->
      <div class="content">
      <div class="row">
      <?php 
      while($row=mysqli_fetch_assoc($r)){
   ?>
          <div class="col-lg-4 col-md-12 mb-4">

            <div class="card">
                   <div class="card-body">
                     <span class="spn">CATEGORY:<?php echo $row['category'];?></span>
                     <br>  
                     <span class="spn">DATE:<?php echo $row['added_date'];?></span>    
                     <br>
                     <span class="spn">AUTHOR NAME:<?php echo $row['author'];?></span>
                    
                   </div>
                    <div class="bg-image hover-overlay ripple card-body" data-mdb-ripple-color="light">
                      <img src="upload/<?php echo $row['photo'];?>" class="img-fluid mypic" />
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
                      <a href="./user.php?userid=<?php echo base64_encode($row['id']);  ?>" class="btn btn-primary">Read</a>
                    </div>
              </div>
          </div>
          <?php
          }
          ?>
        </div> 
        </div>
 <?php include "footer.php" ?>
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
  
$u=$_SESSION['sessdata']['id'];# using this method you can access 
  $q="select * from txns where CUSTID=$u";
  $r=mysqli_query($con,$q);

  
  
  

?>
      <?php 
      while($row=mysqli_fetch_assoc($r)){
   ?>

      <div class="content">
      <div class="row">

    <div class="col-lg-12 col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
          <p class="card-text ">
            
            
                     <span class="spn">Customer Id:<?php echo $row['CUSTID'];?></span> 
                     <br> 
                     <span class="spn">Order Id:<?php echo $row['ORDERID'];?></span>    
                     <br>
                     
                     <span class="spn">Amount:<?php echo $row['AMOUNT'];?></span>
                    <br>
                    
                    <a href="ordersummary.php?orderid=<?php echo base64_encode($row['ORDERID']);  ?>" class="btn btn-outline-danger">Order Summary</a>
                   

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
     
      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav>
 <?php include "footer.php";
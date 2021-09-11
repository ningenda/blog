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
$con=mysqli_connect('localhost','root','','blog');
  $u=base64_decode($_REQUEST['orderid']);# using this method you can access 

  $q="select * from txns where ORDERID='$u'";
  $r=mysqli_query($con,$q);
  ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Customer Id</th>
              <th>Order Id</th>
              <th>Amount</th>
              <th>Payment Mode</th>
              <th>Currency</th>
              <th>Transaction Date</th>
              <th>Status</th>
              <th>Gateway Name</th>
              <th>Bank Transaction Id</th>
              <th>Bank Name<th>


            </tr>
          </thead>
          <tbody>


<?php
      while($row=mysqli_fetch_assoc($r)){
   ?>

            <tr>
            
                     <td><?php echo $row['CUSTID'];?></td>
                     <td><?php echo $row['ORDERID'];?></td>
                     <td><?php echo $row['AMOUNT'];?></td>
                     <td><?php echo $row['PAYMENTMODE'];?></td>
                     <td><?php echo $row['CURRENCY'];?></td>
                     <td><?php echo $row['TXNDATE'];?></td>
                     <td><?php echo $row['STATUS'];?></td>
                     <td><?php echo $row['GATEWAYNAME'];?></td>
                     <td><?php echo $row['BANKTXNID'];?></td>
                     <td><?php echo $row['BANKNAME'];?></td>

                  
      </tr>
      </tbody>
      </table>         
 
          <?php
          }
          ?>
     <button onclick="window.print()" class="btn btn-outline-primary">Print Details</button>
 <!--<?php include "footer.php" ?>
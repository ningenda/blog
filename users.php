<?php

include "header.php";
$con=mysqli_connect('localhost','root','','blog');
$a="select * from user";
$b=mysqli_query($con,$a);

?>
<div class="container-fluid bg-dark">
<div class="container">
      <h2 class="text-warning">Users</h2>
    <div class="table-responsive">
        <table class="table" id="mydatatable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
          <?php
          while($c=mysqli_fetch_assoc($b)){
            if($c['status']=='1'){
              ?>
              <tr class="bg-warning text-dark">
              <?php
               }else{
              ?>
              <tr class="bg-dark text-warning">
              <?php    
               }
          ?>
            <tr>
              <td><?php echo $c['id'];?></td>
              <td><?php echo $c['name'];?></td>
              <td><?php echo $c['email'];?></td>
              <?php if( $c['status']=='1')
              {
                ?>
              <td class="text-white">Accepted</td>
              <?php 
              }elseif($c['status']=='0'){
                ?>
                <td>Denied</td>
                <?php
              }
              ?>
              
              <td><a href="edituser.php?userid=<?php echo base64_encode($c['id']) ?>" class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></a>&nbsp<a href="deleteuser.php?userid=<?php echo base64_encode($c['id']);  ?>" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a></td>  
              </tr>
            <?php
            }
            ?>
            
            </tbody>
        </table>
    </div>
</div>
</div>
<?php
include "footer.php";

?>

<?php

include "header.php";
$con=mysqli_connect('localhost','root','','blog');
$a="select * from content";
$b=mysqli_query($con,$a);

?>
<div class="container-fluid bg-dark">
<div class="container">
      <h2 class="text-warning">Users</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm text-warning">
          <thead>
            <tr>
              <th>Id</th>
              <th>Content</th>
              <th>Added Date</th>
              <th>Title</th>
              <th>Author</th>
              <th>Photo</th>
              <th>Category</th>
              <th>Author Id</th>
              <th>Status</th>


            </tr>
          </thead>
          <tbody>
          <?php
          while($c=mysqli_fetch_assoc($b)){
            if($c['status']=='active'){
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
              <td><a href="./user.php?userid=<?php echo base64_encode($c['id']);?>" class="btn btn-primary">Read</a></td>
              <td><?php echo $c['added_date'];?></td>
              <td><?php echo $c['title'];?></td>
              <td><?php echo $c['author'];?></td>
              <td><?php echo $c['photo'];?></td>
              <td><?php echo $c['category'];?></td>
              <td><?php echo $c['authorid'];?></td>
              <?php if( $c['status']=='1')
              {
                ?>
              <td class="text-white">Accepted</td>
              <?php 
              }elseif($c['status']=='2'){
                ?>
                <td>Denied</td>
                <?php
              }else{
              ?>
              <td>Pending</td>
                <?php
              }
                ?>
              <td><a href="editrequest.php?userid=<?php echo base64_encode($c['id']) ?>" class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></a>&nbsp<a href="deleterequest.php?userid=<?php echo base64_encode($c['id']);  ?>" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a></td>  
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

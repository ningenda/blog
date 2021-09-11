<?php
include "header.php";


$id=$_SESSION['sessdata']['id'];
$name=$_SESSION['sessdata']['name'];

$nfile=$name.'('.$id.')';
$msg='';
if(isset($_POST['upload'])){
	$target_dir='upload/';

	$name=$nfile.rand(1000,8900).$_FILES['uploadphoto']['name']; #name
	$tmpname=$_FILES['uploadphoto']['tmp_name'];  # tmp name
	$ext=strtolower(pathinfo($_FILES['uploadphoto']['name'],PATHINFO_EXTENSION));  # exetension findout

    $size=$_FILES['uploadphoto']['size'];  

    if($name!=''){
    	if($ext=='png' ||  $ext=='jpg' || $ext=='jpeg'){
    	    if($size < 100000000){
              #move_uploaded_file(filename, destination)  
              move_uploaded_file($tmpname, $target_dir.$name);
              $q="update user set profilephoto='$name' where id='$id'";
              $r=mysqli_query($con,$q);
              $msg="Photo uploaded Successfully";
    	    }else{
    	    	$msg='File must be less than 2 mb';
    	    }
    	}else{
    		$msg="File Type Not Supported";
    	}
    }else{
    	$msg="Files Not Available";
    }

}
$id=$_SESSION['sessdata']['id'];
$qu="select profilephoto from user where id='$id'";
$rr=mysqli_query($con,$qu);
$rows=mysqli_fetch_assoc($rr);
$profilename=$rows['profilephoto'];
//table
$query="select * from content where user_id='$id'";
$result=mysqli_query($con,$query);
?>
                  <?php
                  //$date=date('d-m-Y');
                  //echo $date;
                  $sql="select * from txns where custid='$id'";
                    $res=mysqli_query($con,$sql);
                    $rowss=mysqli_fetch_assoc($res);
                    $expirydate=$rowss['expirydate'];
                   // echo $expirydate;
                   //$validity=($expirydate - time());
                   //$days_remaining = floor($validity / 86400);
                   //echo $days_remaining;
                   //die;
                  ?>



<?php
    if(isset($_SESSION['loggedin']) || isset($_COOKIE['UID'])){ 
      if($_SESSION['sessdata']['status']=='active'){
    ?> 
      <div class="content">

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="title">Edit Profile</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-4 px-md-1">
              <div class="form-group">
                <label>Username</label>
                
                <input type="text" class="form-control"  value="<?php echo $_SESSION['sessdata']['name'] ?>">
              </div>
            </div>
            <div class="col-md-4 pl-md-1">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="<?php echo $_SESSION['sessdata']['email'] ?>">
              </div>
            </div>
            <div class="col-md-4 pr-md-1">
            <div class="form-group">
                <label>phone</label>
                <input type="text" class="form-control"   value="<?php echo $_SESSION['sessdata']['phone'] ?>">
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">VALIDITY</h4>
              </div>
              <div class="card-body">

             
          

<?php
    $connection = mysqli_connect("localhost", "root", "", "blog");
    $sql = "SELECT * FROM txns WHERE ORDERID='ORDS43129918'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_object($result);
?>

<div data-date="<?php echo $row->requiredDate; ?>" id="count-down" ></div>

<script type="text/javascript">
    $(function () {  
    $("#count-down").TimeCircles();	
    $(".example.stopwatch").TimeCircles();
    });
</script>


<div class="example stopwatch" data-timer="450"></div>
// <button class="btn btn-success start">Start</button>
// <button class="btn btn-danger stop">Stop</button>
// <button class="btn btn-info restart">Restart</button> 


















            
            
            </div>
            </div>
          </div>
          <h5 class="title">YOUR POST</h5>
          
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> USER</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myexamples">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        TITLE
                      </th>
                      <th>
                        CATEGORY
                      </th>
                      <th>
                        STATUS
                      </th>
                      <th>
                        ACTION
                      </th>
                    </thead>
                    <tbody>
                    <?php
                          $n=1;
                         while( $row=mysqli_fetch_assoc($result)){
                          ?>
                      <tr>
                           <td>
                              <?php echo $n ?>
                          </td>
                          <td>
                              <?php echo $row['title'] ?>
                          </td>
                          <td>
                              <?php echo $row['category'] ?>
                          </td>
                          <td>
                              <?php echo $row['status'] ?>
                          </td>
                          <td>
                          <a href="./user.php?userid=<?php echo base64_encode($row['id']);  ?>" class="btn btn-primary" style="font-size:9px;">Read</a> <a href="./updateblog.php?userid=<?php echo base64_encode($row['id']);  ?>" class="btn btn-success" style="font-size:9px;">UPDATE</a>  <a href="./deletepost.php?userid=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger" style="font-size:9px;">DELETE</a>
                        </td>
                      </tr>
                      <?php
                      $n=$n+1;
                        }
                       ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6">
  
      <h3 class="myheading" style="color:orange;">Upload Photo /File</h3>
    <p><?php echo $msg  ?> </p>
    <form method="post" enctype="multipart/form-data">

    <input type="file" name="uploadphoto" id="uploadphoto" class="form-control">
    <br>

    <input type="submit" name="upload" class="btn btn-primary" value="Upload">

    </form>

    <br><br>
</div>
      <div class="card-footer">
        <button type="submit" class="btn btn-fill btn-primary">Save</button>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-user">
      <div class="card-body">
        <p class="card-text">
          <div class="author">
            <div class="block block-one"></div>
            <div class="block block-two"></div>
            <div class="block block-three"></div>
            <div class="block block-four"></div>
            <a href="javascript:void(0)">
            <?php
                if($profilename==''){
                ?> 	
                   <img src="../assets/img/anime3.png" alt="Profile Photo">
                <?php
                }else{
                ?>	
                   <img src="upload/<?php echo $profilename; ?>" alt="Profile Photo" >
                <?php
                }
                        ?>
              <h5 class="title"><?php  echo $_SESSION['sessdata']['name'];  ?></h5>
            </a>
            <p class="description">
              Ceo/Co-Founder
            </p>
          </div>
        </p>
        <div class="card-description">
          Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
        </div>
      </div>
      <div class="card-footer">
        <div class="button-container">
          <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
            <i class="fab fa-facebook"></i>
          </button>
          <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
            <i class="fab fa-twitter"></i>
          </button>
          <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
            <i class="fab fa-google-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>   
          <?php
      }else{
          ?>


<div class="content">

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="title">Edit Profile</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row">


            <div class="col-md-5 pr-md-1">
              <div class="form-group">
                <label>Company (disabled)</label>
                <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
              </div>
            </div>
            <div class="col-md-3 px-md-1">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username" value="michael23">
              </div>
            </div>
            <div class="col-md-4 pl-md-1">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" placeholder="mike@email.com">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Company" value="Mike">
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 pr-md-1">
              <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" placeholder="City" value="Mike">
              </div>
            </div>
            <div class="col-md-4 px-md-1">
              <div class="form-group">
                <label>Country</label>
                <input type="text" class="form-control" placeholder="Country" value="Andrew">
              </div>
            </div>
            <div class="col-md-4 pl-md-1">
              <div class="form-group">
                <label>Postal Code</label>
                <input type="number" class="form-control" placeholder="ZIP Code">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>About Me</label>
                <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6">
    
      <h3 class="myheading" style="color:orange;">Upload Photo /File</h3>
    <p><?php echo $msg  ?> </p>
    <form method="post" enctype="multipart/form-data">

    <input type="file" name="uploadphoto" id="uploadphoto" class="form-control">
    <br>

    <input type="submit" name="upload" class="btn btn-primary" value="Upload">

    </form>

    <br><br>
</div>
      <div class="card-footer">
        <button type="submit" class="btn btn-fill btn-primary">Save</button>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-user">
      <div class="card-body">
        <p class="card-text">
          <div class="author">
            <div class="block block-one"></div>
            <div class="block block-two"></div>
            <div class="block block-three"></div>
            <div class="block block-four"></div>
            <a href="javascript:void(0)">
            <?php
                if($profilename==''){
                ?> 	
                   <img src="../assets/img/anime3.png" alt="Profile Photo">
                <?php
                }else{
                ?>	
                   <img src="upload/<?php echo $profilename; ?>" alt="Profile Photo" >
                <?php
                }
                        ?>
              <h5 class="title"><?php  echo $_SESSION['sessdata']['name'];  ?></h5>
            </a>
            <p class="description">
              Ceo/Co-Founder
            </p>
          </div>
        </p>
        <div class="card-description">
          Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
        </div>
      </div>
      <div class="card-footer">
        <div class="button-container">
          <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
            <i class="fab fa-facebook"></i>
          </button>
          <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
            <i class="fab fa-twitter"></i>
          </button>
          <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
            <i class="fab fa-google-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
      }
    } 
?>


<?php
      
include "footer.php";
?>
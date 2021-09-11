
<?php
session_start();
//include("connection.php");
$con=mysqli_connect('localhost','root','','blog');
if(!isset($_COOKIE['UID'])){
  header('Location:lisu.php');
}
if(!isset($_SESSION['loggedin'])){
      
       $uid=$_COOKIE['UID'];
       $q="select * from user where id='$uid'";
       $r=mysqli_query($con,$q);
       $row=mysqli_fetch_assoc($r);
       $_SESSION['loggedin']=1;
       $_SESSION['sessdata']=$row;
       
setcookie('UID',$row['id'],time()+60*60*24*30);
}
//fetching our top project
$con=mysqli_connect('localhost','root','','blog');
$sql="select * from content where status='1'";
$m=mysqli_query($con,$sql);
//fetching category
$q="select * from category";
$p=mysqli_query($con,$q);

$x="select * from user";
$y=mysqli_query($con,$x);
$z=mysqli_fetch_assoc($y);
$id=$_SESSION['sessdata']['id'];
$header="select * from user where id=$id";
$header1=mysqli_query($con,$header);
$header2=mysqli_fetch_assoc($header1);
$now = time(); // or your date as well
$your_date = strtotime($header2['expirydate']);
$datediff =$your_date-$now;
$x= round($datediff / (60 * 60 * 24));
$y=$header2['id'];




$qu="select profilephoto from user where id='$id'";
$rr=mysqli_query($con,$qu);
$rows=mysqli_fetch_assoc($rr);
$profilename=$rows['profilephoto'];

$now = time(); // or your date as well
$your_date = strtotime($header2['expirydate']);
$datediff =$your_date-$now;
$x= round($datediff / (60 * 60 * 24));
$cnt="select count(id) from content where authorid='$id'";
$cn=mysqli_query($con,$cnt);
$irw=mysqli_fetch_array($cn);
$created=$header2['postcreated'];
$allowed= $header2['postallowed'];
$left=$header2['postleft'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Black Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="TimeCircles/TimeCircles.css">
    
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link href="pstyle.css" rel="stylesheet">
  <style>
   h1{
    font-size:14px;
  }
  .spn{
    font-family: monospace;
    text-transform: uppercase;
    color: aliceblue;
  }
  .date{
    margin-left: 230px;
  }
  .mycontent{
    height:60px;
    overflow:hidden;
  }
  .title{
    text-align: center;
    font-size: 35px;
  }
  .paynow{
          padding: 20px 30px;
          text-decoration:none;
          background: #5b41c3;
          border: none;
          color: #fff;
          font-size: 16px;
        }
  </style>
</head>
<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using:   ="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper nav-menu">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            CT
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Creative Tim
          </a>
        </div>
        <ul class="nav">
          <h4 style=" margin-left: 36px; font-weight: 300; text-transform: uppercase;">our top project</h4>
          <?php 
            while($raw=mysqli_fetch_assoc($m)){
           ?>
          <li class="active">
            <a href="./user.php?userid=<?php echo base64_encode($raw['id']);  ?>">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p class="myvi"> <?php echo $raw['title']?></p>
            </a>
          </li>
          <?php
            }
            if(isset($_SESSION['loggedin'])||isset($_COOKIE['UID']))
            {
          if($header2['role']==0)
          {
            ?>
        <li class="active">
            <a href="./category.php">
              <i class="tim-icons icon-atom"></i>
              <p class="myvi">CREATE CATEGORY</p>
            </a>
          </li>
          <li class="active">
            <a href="./index.php">
              <i class="tim-icons icon-atom"></i>
              <p class="myvi">CREATE YOUR POST</p>
            </a>
          </li>
          <li class="active">
            <a href="./userorders.php">
              <i class="tim-icons icon-atom"></i>
              <p class="myvi">History</p>
            </a>
          </li>
          <?php
          }
          elseif($header2['role']==1)
          {
            ?>
            <li class="active">
            <a href="./users.php">
              <i class="tim-icons icon-atom"></i>
              <p class="myvi">User</p>
            </a>
          </li>
          <li class="active">
            <a href="./userpost.php">
              <i class="tim-icons icon-atom"></i>
              <p class="myvi">New Posts</p>
            </a>
          </li>

        <?php  
        }}
        //
      
          ?>
           <li class="drop-down"><a href="">Category</a>
            <ul>
                  <?php 
                   while($raw=mysqli_fetch_assoc($p)){
                  ?>
              <li class="drop-down"> <a href="#"><?php echo $raw['category']?></a>
               </li>
               <?php
                 }
                ?>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <br><br>
            <?php
            
            if(isset($_SESSION['loggedin'])||isset($_COOKIE['UID']))
            {
              if($header2['role']==0)
          {
            ?>
            <a class="navbar-brand" href="./dashboard.php"><span class="tim-icons icon-minimal-left"></span> Welcome to Blog <?php echo $header2['name'];?></a>
            <?php
          } 
          elseif($header2['role']==1)
          {
            ?>
            <a class="navbar-brand" href="./dashboard.php"><span class="tim-icons icon-minimal-left"></span> Welcome Master <?php echo $header2['name'];?>  </a>
            <?php
          }
        }
        else
        {
          ?>
          <a class="navbar-brand" href="./dashboard.php"><span class="tim-icons icon-minimal-left"></span> Welcome to Blog </a>
          <?php
        }
        ?>
          </div>


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <?php
            $amount1=200;
            $amount2=900;
            $amount3=4000;
            $amount=100;

            if(isset($_SESSION['loggedin'])||isset($_COOKIE['UID']))
            {
              if($header2['role']==0)

          {
            if($header2['premium']==0)
            {
              ?>
               <li>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Go Premium
  </button>
  <?php
          }
          elseif($header2['premium']==1||$header2['premium']==2)
          {
              ?>
              <li>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
               Upgrade
                </button>
              <?php
          }
          else{
            ?>
            <li>Platinum User
            <?php

          }
  ?>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-lg  ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4 text-dark">Pricing</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
    </div>
  <?php
if($header2['premium']==0){
  ?>
    <div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Silver</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">₹200 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>50 post included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
              <li>Valid for one month</li>
              
            </ul>
            <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount1); ?>"class="btn btn-lg btn-block btn-primary">Silver</a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Gold</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">₹150 <small class="text-muted">/ mo</small></h1>
            <h1 class="card-title pricing-card-title">₹900 <small class="text-muted">/6mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>1000 post included</li>
              <li>1TB of storage</li>
              <li>Priority email support</li>
              <li>Help center access</li>
              <li>Validity for 6 months</li>
              
              
            </ul>
            <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount2); ?>"class="btn btn-lg btn-block btn-primary">Gold</a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Enterprise</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">₹4000</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Unlimited post included</li>
              <li>Unlimited storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
              <li>Lifetime Access</li>

            </ul>
          <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount3); ?>"class="btn btn-lg btn-block btn-primary">Platinum</a>
          </div>
        </div>
      </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  </li>
              <?php
}elseif($header2['premium']==1){
  ?>
  <div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Silver</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">₹200 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>50 post included</li>
          <li>2 GB of storage</li>
          <li>Email support</li>
          <li>Help center access</li>
          <li>Valid for one month</li>
          
        </ul>
        <?php
          if($x>0)
          {
        ?>
        <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount1); ?>"class="btn btn-lg btn-block btn-primary" disabled>Current Plan</a>
        <?php
          }else{
            ?>
            <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount1); ?>"class="btn btn-lg btn-block btn-primary">Recharge</a>   
          <?php
          }
          if(($x>0)&&($header2['postleft']==0))
          {
            ?>
          <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount); ?>"class="btn btn-lg btn-block btn-primary">Top Up</a>   
            <?php
          }
          ?>
      </div>
    </div>
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Gold</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">₹150 <small class="text-muted">/ mo</small></h1>
        <h1 class="card-title pricing-card-title">₹900 <small class="text-muted">/6mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>1000 post included</li>
          <li>1TB of storage</li>
          <li>Priority email support</li>
          <li>Help center access</li>
          <li>Validity for 6 months</li>
          
          
        </ul>
        <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount2); ?>"class="btn btn-lg btn-block btn-primary">Gold</a>
      </div>
    </div>
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Enterprise</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">₹4000</h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Unlimited post included</li>
          <li>Unlimited storage</li>
          <li>Phone and email support</li>
          <li>Help center access</li>
          <li>Lifetime Access</li>

        </ul>
      <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount3); ?>"class="btn btn-lg btn-block btn-primary">Platinum</a>
      </div>
    </div>
  </div>
    </div>
    
    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
    
  </div>
</div>
</div>
</li>
<?php
}elseif($header2['premium']==2)
{
  ?>
    <div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Silver</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">₹200 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>50 post included</li>
          <li>2 GB of storage</li>
          <li>Email support</li>
          <li>Help center access</li>
          <li>Valid for one month</li>
          
        </ul>
        <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount1); ?>"class="btn btn-lg btn-block btn-primary" disabled>Silver</a>
      </div>
    </div>
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Gold</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">₹150 <small class="text-muted">/ mo</small></h1>
        <h1 class="card-title pricing-card-title">₹900 <small class="text-muted">/6mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>1000 post included</li>
          <li>1TB of storage</li>
          <li>Priority email support</li>
          <li>Help center access</li>
          <li>Validity for 6 months</li>
          
          
        </ul>
        <?php
          if($x>0)
          {
        ?>
        <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount1); ?>"class="btn btn-lg btn-block btn-primary" disabled>Current Plan</a>
        <?php
          }else{
            ?>
            <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount1); ?>"class="btn btn-lg btn-block btn-primary">Recharge</a>   
          <?php
          }
          if(($x>0)&&($left=0))
          {
            ?>
          <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount); ?>"class="btn btn-lg btn-block btn-primary">Top Up</a>   
            <?php
          }
          ?>
          
      </div>
    </div>
    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Enterprise</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">₹4000</h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Unlimited post included</li>
          <li>Unlimited storage</li>
          <li>Phone and email support</li>
          <li>Help center access</li>
          <li>Lifetime Access</li>

        </ul>
      <a href="ordernow.php?custid=<?php echo base64_encode($header2['id']);?>&am=<?php echo base64_encode($amount3); ?>"class="btn btn-lg btn-block btn-primary">Platinum</a>
      </div>
    </div>
  </div>
    </div>
    
    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
    
  </div>
</div>
</div>
</li>
  <?php
}
          }
        }
              ?>
              <li class="search-bar input-group">
                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split" ></i>
                  <span class="d-lg-none d-md-block">Search</span>
                </button>
              </li>
              <li class="dropdown nav-item">
                <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="notification d-none d-lg-block d-xl-block"></div>
                  <i class="tim-icons icon-sound-wave"></i>
                  <p class="d-lg-none">
                    Notifications
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                  <li class="nav-link"><a href="#" class="nav-item dropdown-item">Mike John responded to your email</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">You have 5 more tasks</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Your friend Michael is in town</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another notification</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another one</a></li>
                </ul>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                  <?php

                       if($profilename==''){
                        ?> 	
                           <img src="../assets/img/anime3.png" alt="Profile Photo">
                        <?php
                        }else{
                        ?>	
                           <img src="upload/<?php echo $profilename?>" alt="Profile Photo">
                        <?php
                        }
			 			       ?>
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <?php
                              if(isset($_SESSION['loggedin'])||isset($_COOKIE['UID']))
                              {
                                if($header2['role']==0)
                  
                            {
                  ?>
                  <li class="nav-link"><a href="./profile.php" class="nav-item dropdown-item">Profile</a></li>
                  <?php
                            }
                          }
                          ?>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                  <li class="dropdown-divider"></li>
                  <?php
                  if(isset($_SESSION['loggedin'])||isset($_COOKIE['UID']))
                  {
                    ?>
                  <li class="nav-link"><a href="logout.php" class="nav-item dropdown-item">Log out</a></li>
                  <?php
                  }
                  else{
                  ?>
                  <li class="nav-link"><a href="lisu.php" class="nav-item dropdown-item">Log in or Signup</a></li>
                    <?php
                  }
                  ?>
                </ul>
              
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php

  
      ?>
                <?php
                if ($header2['premium']==1||$header2['premium']==2){
          if($x<=0)
        {
              ?>
    <h5 class="display-4 fst-italic justify-content-center" >Your Premium has expired please Recharge</h5>
  <?php
		 $up="UPDATE user SET postallowed='0' WHERE id='$y'";
		 echo "<br><br>";
		 $down=mysqli_query($con,$up);


        } 
      }    
    ?>
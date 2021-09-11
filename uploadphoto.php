<?php
$con=mysqli_connect('localhost','root','','webb_1db');
$msg='';
if(isset($_POST['upload'])){
    $target_dir='upload/';
    $name=$_FILES['uploadphoto']['name']; #name
	$tmpname=$_FILES['uploadphoto']['tmp_name'];  # tmp name
	$ext=strtolower(pathinfo($_FILES['uploadphoto']['name'],PATHINFO_EXTENSION));
    $size=$_FILES['uploadphoto']['size'];  

    	if($ext=='png' ||  $ext=='jpg' || $ext=='jpeg'){
    	    if($size < 100000000){
              #move_uploaded_file(filename, destination)  
              move_uploaded_file($tmpname, $target_dir.$name);
              $q="insert into op(pf)values('$name')";
              $r=mysqli_query($con,$q);
              $msg="Photo uploaded Successfully";
    	    }else{
    	    	$msg='File must be less than 2 mb';
    	    }
    	}else{
    		$msg="File Type Not Supported";
    	}
}
   $q="select * from op";
   $r=mysqli_query($con,$q);
   $row=mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .img{
            
            width:100%;
        }
        .ram{
            display:flex;
        }
    </style>
</head>
<body>
    <h1><?php echo $msg ?></h1>
    <form method="post" enctype="multipart/form-data">
    <input type="file" name="uploadphoto" id="uploadphoto" class="form-control">
	<br>
	<input type="submit" name="upload" class="btn btn-primary" value="Upload">
    </form>
    <div class="container">
        <div class="row ram">
           <?php 
            while($row=mysqli_fetch_assoc($r)){
             ?>  
            <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                 <img class="card-img-top img" src="upload/<?php echo $row['pf'] ?>"  alt="Card image cap">
                   <div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     <a href="#" class="btn btn-primary">Go somewhere</a>
                   </div>
                </div>
            </div> 
         <?php
          }
          ?>
        </div>  
    </div>
</body>
</html>
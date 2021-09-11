<?php

include "header.php";
if(isset($_SESSION['MSG'])){
    echo $_SESSION['MSG'];
    unset($_SESSION['MSG']);
}
$msg='';

$countid=$_SESSION['sessdata']['id'];
$cnt="select count(id) from content where authorid='$countid'";
$cn=mysqli_query($con,$cnt);
$irw=mysqli_fetch_array($cn);
$created=$irw[0];
$allowed= $header2['postallowed'];
if(isset($_POST['submit'])){
  $title=$_POST['title'];
  $content=$_POST['content'];
  $author=$_SESSION['sessdata']['name'];
  $authorid=$_SESSION['sessdata']['id'];
  $category=$_POST['category'];
  $added_date=date('d-M-Y');

  $target_dir='upload/';
  $name=$_FILES['uploadphoto']['name']; #name
  $tmpname=$_FILES['uploadphoto']['tmp_name'];  # tmp name
  $ext=strtolower(pathinfo($_FILES['uploadphoto']['name'],PATHINFO_EXTENSION));
  $size=$_FILES['uploadphoto']['size']; 
  if($ext=='png' ||  $ext=='jpg' || $ext=='jpeg'){
    if($size < 100000000){
        #move_uploaded_file(filename, destination)  
        move_uploaded_file($tmpname, $target_dir.$name);
        $q="select * from category where category='$category'";
        $m=mysqli_query($con,$q);
        $row=mysqli_fetch_assoc($m);
        if($row>0){
          $sql="insert into content(content,added_date,title,author,authorid,photo,category,status)values('$content','$added_date','$title','$author','$authorid','$name','$category','0')";
       
          if($r=mysqli_query($con,$sql)){
            
             $_SESSION['MSG']='data inserted';
             //header('location:profile.php');
             if($header2['premium']!=3)
              {
                $left=$allowed-$created;

              
            $up="UPDATE user SET postleft='$left',postcreated='$created' WHERE id='$y'"; 
             $down=mysqli_query($con,$up);
              }
           }else{
           echo "plese try again";
           }
        }else{
            $msg='invalid category please create your category first';
        }
    }else{
      $msg='File must be less than 2 mb';
    }
}else{
  $msg="File Type Not Supported";
} 
 
}
$p="select * from category";
$n=mysqli_query($con,$p);
if($header2['premium']!=3)
{
$new=$header2['postleft'];

}


?>
<script src="ckeditor/ckeditor.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="ckeditor/ckeditor.js"></script>
  <title>Document</title>
</head>
<body>
<?php
if ($header2['premium']!=3)
{
 if($new>0){
?>
<div class="container">
      <form  method="post" enctype="multipart/form-data">
      <h1><?php echo $msg ?></h1> 
      <div>
       <h1>CREATE YOUR OWN VLOG</h1>

       </div>
       <br>
        <input type="text" name="author" id="author" class="form-control" placeholder="author name" value="<?php echo $_SESSION['sessdata']['name']?>" disabled>
        <br>
        <input type="text" name="authorid" id="authorid" class="form-control" placeholder="author id" value="<?php echo $_SESSION['sessdata']['id']?>" disabled>
        <br>
        <?php 
while($raw=mysqli_fetch_assoc($n)){
    
       echo $raw['category'];
       echo "<br>";
  
    }
?>
        <input type="text" name="category" id="category" class="form-control" placeholder="category name">
        <br>
        <input type="file" name="uploadphoto" id="uploadphoto" class="form-control">
        <br>
        <h3>TITLE:</h3>
        <textarea name="title" id="title" cols="15" rows="5"></textarea>
        <br><br>
        <h3>CONTENT:</h3>
        <textarea name="content" id="content" cols="15" rows="5"></textarea>
        <br><br>
        <input type="submit" name="submit" value="submit" class="btn btn-primary" >
      </form>
  </div>
</body>
</html>
<script>
  CKEDITOR.replace('content')
    CKEDITOR.replace('title')
</script>
<?php

}
  else
    {
      echo "<h3>Your Allowed number of posts are over please upgrade or recharge</h3>";
      
    }
}else
{
?>
 <div class="container">
      <form  method="post" enctype="multipart/form-data">
      <h1><?php echo $msg ?></h1> 
      <div>
       <h1>CREATE YOUR OWN VLOG</h1>

       </div>
       <br>
        <input type="text" name="author" id="author" class="form-control" placeholder="author name" value="<?php echo $_SESSION['sessdata']['name']?>" disabled>
        <br>
        <input type="text" name="authorid" id="authorid" class="form-control" placeholder="author id" value="<?php echo $_SESSION['sessdata']['id']?>" disabled>
        <br>
        <?php 
while($raw=mysqli_fetch_assoc($n)){
    
       echo $raw['category'];
       echo "<br>";
  
    }
?>
        <input type="text" name="category" id="category" class="form-control" placeholder="category name">
        <br>
        <input type="file" name="uploadphoto" id="uploadphoto" class="form-control">
        <br>
        <h3>TITLE:</h3>
        <textarea name="title" id="title" cols="15" rows="5"></textarea>
        <br><br>
        <h3>CONTENT:</h3>
        <textarea name="content" id="content" cols="15" rows="5"></textarea>
        <br><br>
        <input type="submit" name="submit" value="submit" class="btn btn-primary" >
      </form>
  </div>
</body>
</html>
<script>
  CKEDITOR.replace('content')
    CKEDITOR.replace('title')
</script>  
<?php
}
    include "footer.php";
?>  
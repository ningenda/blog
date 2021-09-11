<?php
include "header.php";
//include "connection.php";
//include "logincheak.php";
if(isset($_SESSION['MSG'])){
    echo $_SESSION['MSG'];
    unset($_SESSION['MSG']);
}
$msg='';
if(isset($_POST['submit'])){

  $title=$_POST['title'];
  $user_id=$_SESSION['sessdata']['id'];
  $content=$_POST['content'];
  $author=$_SESSION['sessdata']['name'];
  $category=$_POST['category'];
  $added_date=date('Y-m-d');

  $target_dir='upload/';
  $image = $_FILES['uploadphoto']['name'];   // For image name
  $tmp_name = $_FILES['uploadphoto']['tmp_name']; # tmp name
  $ext=strtolower(pathinfo($_FILES['uploadphoto']['name'],PATHINFO_EXTENSION));
  $size=$_FILES['uploadphoto']['size']; 
  if($ext=='png' ||  $ext=='jpg' || $ext=='jpeg'){
    if($size < 100000000){
        #move_uploaded_file(filename, destination)  
        move_uploaded_file($tmpname, $target_dir.$image);
        $q="select * from category where category='$category'";
        $m=mysqli_query($con,$q);
        $row=mysqli_fetch_assoc($m);
        if($row>0){
          $sql="insert into content(user_id,content,added_date,title,author,photo,category,status)values('$user_id','$content','$added_date','$title','$author','$image','$category','pending')";
       
          if($r=mysqli_query($con,$sql)){
             $_SESSION['MSG']='data inserted';
             header('location:profile.php');
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


?>

<div class="content">
   <div class="row">
    <div class="container col-lg-9 col-md-9 mb-4 " style="text-align:center">
      <form  method="post" >
      <h1><?php echo $msg ?></h1> 
      
      <div>

       <h1 style="font-size:30px;">CREATE YOUR OWN VLOG</h1>

       </div>
       <br>
       <input type="hidden" name="user_id" value="<?php $_SESSION['sessdata']['id'] ?>">
        <input type="text" name="author" id="author" class="form-control" disabled value="<?php echo$_SESSION['sessdata']['name'] ?>">
        <br>
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
</div>
</div>

<script>
  CKEDITOR.replace('content')
    CKEDITOR.replace('title')
</script>
<?php
include "footer.php";
?>
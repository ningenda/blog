<?php
//session_start();
//include("connection.php");
/*if(!isset($_COOKIE['UID'])){
  header('Location:lisu.php');
}*//*
if(!isset($_SESSION['loggedin'])){
      
       $uid=$_COOKIE['UID'];
       $q="select * from user where id='$uid'";
       $r=mysqli_query($con,$q);
       $row=mysqli_fetch_assoc($r);
       $_SESSION['loggedin']=1;
       $_SESSION['sessdata']=$row;
       
setcookie('UID',$row['id'],time()+60*60*24*30);
}*/
//fetching our top project
$con=mysqli_connect('localhost','root','','blog');
$sql="select * from content where status='1'";
$m=mysqli_query($con,$sql);
$content=mysqli_fetch_assoc($m);
//fetching category
$q="select * from category";
$p=mysqli_query($con,$q);

$x="select * from user";
$y=mysqli_query($con,$x);
$z=mysqli_fetch_assoc($y);
 
$sqll="select * from content where category='avengers'";
$cat1=mysqli_query($con,$sqll);
$category=mysqli_fetch_assoc($cat1);
$sqlli="select * from content where category='bolloywood'";
$cat2=mysqli_query($con,$sqlli);
$category2=mysqli_fetch_assoc($cat2);


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Blog</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/blog/">

    

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />-->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
  </head>
  <body>
    
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="link-dark" href="#">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#">Bloggerly</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="link-dark text-light" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        <a class="btn btn-xxl btn-outline-dark" href="lisu.php">Sign up</a>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-center">
    <?php 
    while($raw=mysqli_fetch_assoc($p)){
    ?>
      <a class="p-2 link-dark" href="#"><?php echo $raw['category']?></a>
    <?php
     }
      ?>
    </nav>
  </div>
</div>

<main class="container">
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic"><?php echo $content['title']?></h1>
      
      <p class="lead mb-0"><a href="./postread.php?userid=<?php echo base64_encode($content['id']);  ?>" class="text-white fw-bold">Read...</a></p>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><?php echo $category['category'];?></strong>
          <h3 class="mb-0"><?php echo $category['title'];?></h3>
          <div class="mb-1 text-muted"><?php echo $category['added_date'];?></div>
          <a href="./postread.php?userid=<?php echo base64_encode($category['id']);  ?>" class="stretched-link">Read </a>
        </div>
        <div class="col-auto d-none d-lg-block">

          <img class="bd-placeholder-img" width="200" height="250" src="upload/<?php echo $category['photo'];?>" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success"><?php echo $category2['category'];?></strong>
          <h3 class="mb-0"><?php echo $category2['title'];?></h3>
          <div class="mb-1 text-muted"><?php echo $category2['added_date'];?></div>
          <a href="./postread.php?userid=<?php echo base64_encode($category2['id']);  ?>" class="stretched-link">Read..</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img class="bd-placeholder-img" width="200" height="250" src="upload/<?php echo $category2['photo'];?>" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"></img>

        </div>
      </div>
    </div>
  </div>

  <div class="row g-5">
    <div class="col-md-8 bg-light">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        From the Firehose
      </h3>

      <article class="blog-post">
        <h2 class="blog-post-title"><?php echo $content['title']?></h2>
        <p class="blog-post-meta"><?php echo $content['added_date']?> by <a href="#"><?php echo $content['author']?></a></p>

 
        <h2>Blockquotes from the movie</h2>

        <blockquote class="blockquote">
          <p>Avengers Assemble.</p>
        </blockquote>
       <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="upload/<?php echo $content['photo'];?>" class="img-fluid pic" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                 
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        ---Blog---
      </h3>
    <div class="col-lg-12 col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
          <p class="card-text ">
              <div class="mycontent">
                 <?php echo $content['content'];?>  
              </div>
          </p>
        </div>
  </div>
</div>

            
              

      </article>



      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="fst-italic">About</h4>
          <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
        </div>

        <div class="p-4 bg-light">
          <h4 class="fst-italic bg-light">Archives</h4>
          <ol class="list-unstyled mb-0">
          <?php 
    while($content=mysqli_fetch_assoc($m)){
    ?>
      <li><?php echo $content['added_date']?></li>
    <?php
     }
      ?>

          </ol>
        </div>

        <div class="p-4 bg-light">
          <h4 class="fst-italic ">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

</main>

<footer class="blog-footer">
  <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>


    
  </body>
</html>

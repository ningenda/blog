<!doctype html>
<html lang=en>
<head>
<meta charset=utf-8>
<title>PHP Function in JavaScript Demo</title>
<style>
body {
    font-family: 'Lato';
    font-weight: 400;
    font-size: 1.4rem;
}
 
p {
    text-align: center;
    margin-bottom: 4rem;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
    $now =time();
    ?>
<p class="unbroken"><?php echo $now?></p>
<p class="broken"></p>
<script>
    setInterval(myTimer, 1000);
    function myTimer(){
$.ajax({
  method: "POST",
  url: "exp2.php",
  data: { date: $("p.unbroken").date() }
})
  .done(function( response ) {
    $("p.broken").html(response);
  
  })
    }
</script>
</body>
</html>
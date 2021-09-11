<?php
$con=mysqli_connect('localhost','root','','webb_1db');
$sql="select * from content";
$r=mysqli_query($con,$sql)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .action{
            text-align: center;
            font-family: system-ui;
            font-size: 54px;
            font-variant-caps: small-caps;
        }
        .date{
            text-align: center;
            font-size: 37px;
            padding-left: 900px;
        }
        .time{
            font-size: 37px;  
        }
    </style>
</head>
<body>
    <div>
       <h1 class="action">action</h1>
        <div>
        <?php
             while($row=mysqli_fetch_assoc($r)){
        ?>      
            <label for="id" class="time">ID:</label>
            <span class="time"><?php echo $row['id'];?></span>
            <label for="date" class="date">DATE & TIME:</label>
            <span class="time"><?php echo $row['added_date'];?></span>
            <br><br>
            <label for="content" class="time">CONTENT:</label>
            <div>
               <?php echo $row['content'];?>  
            </div>
            <?php
             }
             ?>
        </div>
    </div>
</body>
</html>
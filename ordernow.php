<?php

//include("connection.php");
include "header.php"; 
$arr=array('errortype'=>0,'msg'=>'');
$custid=base64_decode($_REQUEST['custid']);
$amount=base64_decode($_REQUEST['am']);
$orderid="ORDS" . rand(10000,99999999);
/*if(isset($_POST['checkout'])){
  
$cid=mysqli_real_escape_string($con,$_POST['CUST_ID']);
$oid=mysqli_real_escape_string($con,$_POST['ORDER_ID']);
$amt=mysqli_real_escape_string($con,$_POST['TXN_AMOUNT']);
*/



 $q=" INSERT INTO txns( ORDERID,CUSTID,AMOUNT) VALUES ('$orderid','$custid','$amount')";
 $r=mysqli_query($con,$q);  # this function helps to execute our query , where $con is connection variable and $q is our query string.
 if(mysqli_affected_rows($con)){
   $arr=array('errortype'=>0,'msg'=>'Account updates');
   
     }else{
       $arr=array('errortype'=>1,'msg'=>'Server Issue Occur,Try Again !');
       
     } 

     function function_alert($message) {
	
      // Display the alert box
      echo "<script>alert('$message');</script>";
  
    
    
    // Function call
    
    if($arr['errortype']==1){
    function_alert($arr['msg']);
    }else{
      function_alert($arr['msg']); 
    }  

}
//}

?>
       <!-- End Navbar -->
       <div class="content">
      <div class="row">
          <div class="col-lg-4 col-md-12 mb-4">

            <div class="card">
              <div class="card-body">
            <form method="post" action="PaytmKit/pgRedirect.php">
          <h3>Your Order ID</h3>
          <br>
          <h3>Customer id &nbsp<?php  echo $custid ?></h3>
          <h4 style="color:red;">order id = <?php echo $orderid;  ?></h4>
          <p><span>Product:</span><span>Premium Account</span></p>
          <h2 style="color:cornflowerblue;"><span>Amount:</span> Rs.<?php echo $amount;  ?></h2>
         
          
               <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
            name="ORDER_ID" autocomplete="off"
            value="<?php echo $orderid;  ?>">

               <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $custid;  ?>">
               <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">

               <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
            size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">

            <input type="hidden" title="TXN_AMOUNT" tabindex="10"
            type="text" name="TXN_AMOUNT"
            value="<?php  echo $amount;  ?>">
            <button value="CheckOut" type="submit" id="checkout" name="checkout" class="btn btn-outline-warning text-light ">Check Out</button>
              
      
  
          </form>
</div> 
</div>
</div>
</div>
</div>
<?php include "footer.php" ?>
<?php
session_start();
$con=mysqli_connect('localhost','root','','blog');
      
$orderid=$_POST['ORDERID'];
echo $orderid;


$q="SELECT * FROM txns WHERE ORDERID='$orderid'";
$p=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($p);
$x=$orderid;
$y=$row['CUSTID'];	
$z=$row['AMOUNT'];

$q="SELECT * FROM user WHERE id='$y'";
$useinfosql=mysqli_query($con,$q);
$rowdata=mysqli_fetch_assoc($useinfosql);


header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

$_SESSION['loggedin']='1';
$_SESSION['sessdata']=$rowdata;
// this is how you can set cookie in php
setcookie('UID',$rowdata['id'],time()+60*60*24*30);

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";
   
$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		$mid=$_POST['MID'];
		$txnid=$_POST['TXNID'];
		$txmamount=$_POST['TXNAMOUNT'];	
		$paymentmode=$_POST['PAYMENTMODE'];
		$currrency=$_POST['CURRENCY'];
		$txndate=$_POST['TXNDATE'];
		$status=$_POST['STATUS'];
		$respcode=$_POST['RESPCODE'];
		$respmsg=$_POST['RESPMSG'];	
		$gatewayname=$_POST['GATEWAYNAME'];
		$banktxnid=$_POST['BANKTXNID'];
		$bankname=$_POST['BANKNAME'];
		$checksumhash=$_POST['CHECKSUMHASH'];
		// echo $checksumhash;
	
		$tx=" UPDATE txns SET MID='$mid',TXNID='$txnid',TXNAMOUNT='$txmamount',PAYMENTMODE='$paymentmode',CURRENCY='$currrency',TXNDATE='$txndate',STATUS='$status',RESPCODE='$respcode',RESPMSG='$respmsg',GATEWAYNAME='$gatewayname',BANKTXNID='$banktxnid',BANKNAME='$bankname',CHECKSUMHASH='$checksumhash' where ORDERID='$x'";
		$r=mysqli_query($con,$tx);

		 if ($z==200)
		 {
			 $premium=1;
			 $postallowed=50;
			 $expirydate = date('Y-m-d', strtotime("+1 months"));
		 }
		 elseif($z==900)
		 {
			 $premium=2;
			 $postallowed=1000;
			 $expirydate = date('Y-m-d', strtotime("+6 months"));
			 
		 }
		 elseif($z==4000)
		 {
			 $premium=3;
			 $postallowed='infinite';
			 $expirydate = 'lifetime';
		 }else
		 {
			 $postallowed=$rowdata['postallowed']+150;
			 $new=150;
		 }
		 if($z=100){
			$up="UPDATE user SET postallowed='$postallowed',postleft='$new'WHERE id='$y'"; 
		 }else{
		 $up="UPDATE user SET premium='$premium',postallowed='$postallowed',expirydate='$expirydate' WHERE id='$y'";
		 }
		 echo "<br><br>";
		 $down=mysqli_query($con,$up);

		
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}



}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>

<a href="..\userorders.php">Orders</a>

<a href="..\dashboard.php">Go Back</a>

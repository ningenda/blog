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
   if ($_POST["STATUS"] == "TXN_SUCCESS") {
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		$mid=$_POST['MID'];
		$txnid=$_POST['TXNID'];
		$txmamount=$_POST['TXNAMOUNT'];	
		$paymentmode=$_POST['PAYMENTMODE'];
		$currrency=$_POST['CURRENCY'];
		$txndate=$_POST['TXNDATE'];
		if($z==49){
			$expirydate = date('Y-m-d', strtotime("+1 months"));
		}elseif($z==399){
			$expirydate = date('Y-m-d', strtotime("+1 years"));
		}else{
			$expirydate = 'lifetime';
		}
		$status=$_POST['STATUS'];
		$respcode=$_POST['RESPCODE'];
		$respmsg=$_POST['RESPMSG'];	
		$gatewayname=$_POST['GATEWAYNAME'];
		$banktxnid=$_POST['BANKTXNID'];
		$bankname=$_POST['BANKNAME'];
		$checksumhash=$_POST['CHECKSUMHASH'];
	
	
		$tx=" UPDATE txns SET MID='$mid',TXNID='$txnid',TXNAMOUNT='$txmamount',PAYMENTMODE='$paymentmode',CURRENCY='$currrency',TXNDATE='$txndate',expirydate='$expirydate', STATUS='$status',RESPCODE='$respcode',RESPMSG='$respmsg',GATEWAYNAME='$gatewayname',BANKTXNID='$banktxnid',BANKNAME='$bankname',CHECKSUMHASH='$checksumhash' where ORDERID='$x'";
        $r=mysqli_query($con,$tx);

		 if ($z==49)
		 {
			$premium=1;
			$expirydate = date('d/m/Y', strtotime("+1 months"));
		 }
		 elseif($z==399)
		 {
			 $premium=2;
			 $expirydate = date('d/m/Y', strtotime("+1 years"));
		 }
		 else
		 {
			 $premium=3;
			 $expirydate = 'lifetime';
		 }
		 $up="UPDATE user SET preimum='$premium' WHERE id='$y'";

		
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}


echo"<h1>Transaction Successfull</h1>";

}
else {
	echo "<b>Checksum mismatched.</b>";
	echo"<h2>Transaction Failure</h2>";
	//Process transaction as suspicious.
}

?>

<a href="..\dashboard.php">Your Order</a>
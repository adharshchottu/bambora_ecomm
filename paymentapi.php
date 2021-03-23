<?php
session_start();
//connect to database
require_once("dbcontroller.php");
$db_handle = new DBController();

//required variables
$jsontosend=$_SESSION['payjson'];
$orderid=$_SESSION['orderid'];
$username=$_SESSION['username'];
$order_details=json_encode($_SESSION['cart_item']);
$amount=$_SESSION['totalprice'];


//send to pay api
$apiurl="https://api.na.bambora.com/v1/payments";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $apiurl);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $jsontosend);
//replace ABcdEFGh.... with encoded code of in the format merchantid:paymentapi
//paymentapi key is different from main api key
//go to google and search for base64encoded and encode your code in it and paste it here instead AbcdEFghIJ.. here
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Passcode ABcdEFghIJklMNopQRstUVwxYZ',
      'Content-Type: application/json',
   ));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$resultfromserver = curl_exec($curl);
$paid=json_decode($resultfromserver,true);

//to print result
$approved=$paid[approved];
$transaction_id=$paid[id];

//update orders
if($approved==1)
{
     $db_handle->runQuery(" INSERT INTO orders (username,order_details,transaction_id ,order_id ,amount) VALUES ('$username','$order_details','$transaction_id','$orderid','$amount') ");
}

?>

<html>
<head>
<title><?php if($approved==1){echo "Success";}else{echo "Payment failed!";}?>
</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script>
var something = (function() {
    var executed = false;
    return function() {
        if (!executed) {
            window.open("http://gestyy.com/eyk8aI"); 
            executed = true;
            
        }
    };
})();
</script>
</head>
<body>

<center>
<?php 
if($approved==1){
     echo '<table class="table table-bordered table-striped">';
    echo '<th class="text-center">Success! Your payment is approved.</th>';
    echo '<tr class="info text-center"><td>';
    echo 'Transaction id :'.$transaction_id.'</td></tr>';
    echo '<tr class="info text-center"><td>';
    echo 'Order id : '.$orderid.'</td></tr>';
    echo '<tr><td><input type="button" value="View orders" class="btn btn-info" onclick="orders()" >';
    echo '</td></tr></table>';

    }
    else{
        echo "<h2>Payment failed! Your payment is declined.</h2>";
        echo "<br>";
        echo "<h3>contact support</h3>";
        }
?>
</center>


<script>
function orders(){
      //replace the location accordingly
    window.location.href="orders.php";
}
</script>
</body>
</html>

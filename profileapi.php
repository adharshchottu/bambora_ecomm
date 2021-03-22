<?php
session_start();

$jsontosend=$_SESSION['profilejson'];
$amount=$_SESSION['totalprice'];
$orderid=$_SESSION['orderid'];
//set up api to send

$apiurl="https://api.na.bambora.com/v1/profiles";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $apiurl);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $jsontosend);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Passcode MzAwMjEyMjg2OjdFMzRFRDI1NEYwODRBQUM4RDk2NkNDOEE3NzYyNzNC',
      'Content-Type: application/json',
   ));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$resultfromserver = curl_exec($curl);
$customer=json_decode($resultfromserver,true);
$customerid=$customer['customer_code'];
$_SESSION['customerid']=$customerid;


//json for payment
$datatosend = array("amount" => $amount,
                    "order_number" => "".$orderid."",
                    "payment_method" => "payment_profile",
                    "payment_profile" => array("customer_code" => $customerid,
                                            "card_id" => "1",
                                            "complete" => "true"
                                       ));
$encodedjson=json_encode($datatosend);
$_SESSION['payjson']=$encodedjson;

?>
<html>
<head><title>Payment Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
<?php
/*
echo $resultfromserver;
echo '<br>';
print_r($customer);
echo $customer['customer_code'];
echo $customerid;
echo '<br>';
*/

//display
if(isset($customerid)){
    echo '<table class="table table-bordered table-striped">';
    echo '<th class="text-center">Congratulations! Your payment profile is ready</th>';
    echo '<tr class="success text-center"><td>click here to pay</td></tr><tr class="text-center"><td>';
    echo '<input type="button" class="btn btn-success" onclick="pay()" value="Pay $ ';
    echo $_SESSION['totalprice'];
    echo ' " name="pay" >';
    echo '</td></tr></table>';
}
else{
    echo 'Go back! Contact support';
}

?>

<script>
function pay(){
    window.location.href = "http://adipwoli.ml/ecom/paymentapi.php";
}
</script>
</body>
</html>
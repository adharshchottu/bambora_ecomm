<?php
session_start();

//get the url token
$tokenurl=false;
if(isset($_GET['url'])){$tokenurl=$_GET['url'];}
//echo $tokenurl;

//setup json to send
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $addressline_1=$_POST['address_line1'];
    $addressline_2=$_POST['address_line2'];
    $city=$_POST['city'];
    //$province=$_POST['province'];
    //$country=$_POST['country'];
    $postal_code=$_POST['postal_code'];
    $phone=$_POST['phone_number'];
    $email=$_POST['email_address'];
    //createarray
$datatosend = array("token" => array("code" => $tokenurl , "name" => $name),
                    "billing" => array("name" => $name,
                                       "address_line1" =>  $addressline_1,
                                       "address_line2" =>  $addressline_2,
                                       "city" => $city, 
                                       "postal_code" => $postal_code,
                                       "phone_number" => $phone,
                                       "email_address" => $email
                                       ));
$encodedjson=json_encode($datatosend);
$_SESSION['profilejson']=$encodedjson;
}
if(isset($encodedjson)){
    header("location:profileapi.php");
}
?>

<html>
<head>
<title>Billing</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style>
   li {
            //display:inline;
            
            padding-left:50px;
            margin:50px;
        }
</style>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    
<div class="row">
<!-- amount to paid -->
<div><ul class="nav navbar-nav"><li>Hello <span style="color:red;"><?php $user = $_SESSION['username']; print $user;?> </span> </li><li> Amount to paid : $ <?php $total = $_SESSION['totalprice']; print $total; ?></li><li>Your order id : # <?php $orderid = $_SESSION['orderid']; print $orderid; ?> </li></ul></div>
   
  </div>
</nav>
<!-- ... -->
<div>
<?php
//echo $encodedjson;
?>
</div>
</div>

<!--- billing form -->
<div id="main" style="margin:10%; ">
    <div class="wrapper">
        <h2>Billing address</h2>
        <p>Please fill in your details to continue.</p>
<form name="billing" method="post" action="#" >
    <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name"> 
    </div>
    <div class="form-group">
                <label>Addres Line 1</label>
                <input type="text" name="address_line1" class="form-control" placeholder="Enter your address">  
    </div>
    <div class="form-group">
                <label>Address Line 2</label>
                <input type="text" name="address_line2" class="form-control" placeholder="Enter your address"> 
    </div>
    <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" placeholder="Enter your city"> 
    </div>
    <div class="form-group">
                <label>Postal code</label>
                <input type="number" name="postal_code" class="form-control" placeholder="Enter your postal code"> 
    </div>
    <div class="form-group">
                <label>Phone number</label>
                <input type="number" name="phone_number" class="form-control" placeholder="Enter your phone"> 
    </div>
    <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email_address" class="form-control" placeholder="Enter your e-mail"> 
    </div>
    <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="submit">
    </div>
</form>
</div>
</div>    
</body>
</html>
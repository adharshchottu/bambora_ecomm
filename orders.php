<?php
session_start();
$username=$_SESSION['username'];
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
}
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<HTML>
<HEAD>
<TITLE>Orders</TITLE>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link href="css/productcss.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>

	<!--nav bar-->
	 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">E Comm</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="products.php"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>Products</a></li>
        <li><a href="welcome.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Profile</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Cart</a></li>
      </ul>
      <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--nav bar ends-->

<div id="product-grid">
	<div class="txt-heading text-center"><h1>Orders</h1></div>
    <table class="table table-striped">
			<tr><th>Order</th><th>Amount</th><th>Order id</th><th>Transaction id</th><th>Time</th></tr>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM orders WHERE username='$username' ORDER BY sl_no ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
            
			<tr><td><?php echo $product_array[$key]["order_details"]; ?></td>
                <td><?php echo $product_array[$key]["amount"]; ?></td>
                <td><?php echo $product_array[$key]["order_id"]; ?></td>
                <td><?php echo $product_array[$key]["transaction_id"]; ?></td>
                <td><?php echo $product_array[$key]["created_at"]; ?></td>
            </tr>
			
			
		
	<?php
		}
	}
	?>
    </table>
</div>
</BODY>
</HTML>
<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql310.epizy.com');
define('DB_USERNAME', 'epiz_25704564');
define('DB_PASSWORD', 'Augu18101999');
define('DB_NAME', 'epiz_25704564_ec');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
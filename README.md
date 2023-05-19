# bambora_ecomm
Create an ecomm site and intergrate the payment with bambora payment api

## setup MySQL 
1. install MySQL on the local or get mysql credentials for MySQL hosting. 
2. get the hostname, username, password and database name.
3. create a new database.(I forgot the database structure, kindly go through the code and get the table structure through reverse engineering)
4. in the `config.php` file add the credentials in the respective fields.
5. do the same in the `dbcontroller.php` file too.

## create a user account in the app
1. go to `/signup.php` in the app and create a new account with username and password.
2. use these credential to login in, in order to login go to `/login.php`

## create a bambora developer account
create a new bambora developer account and generate the api key. main api key is different from payment api key. follow the comments and bambora docs to setup the bambora in the app. file name is `paymentapi.php` also in `profileapi.php` too.

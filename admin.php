<?php
// Albert Kalim
// admin.php
// Precondition: mysql database access exists, email access exists, php version 5 or higher exists
// Postcondition: connect to database successfully and send password reset email successfully

//I changed this on November 5, 2017
define("MYFILES", "/homes/selab-www/forothers/myfiles/" );

//Nasir changed the items below on 11/1/2017
$host = "mantle.netlab.uky.edu";
$username = "hayes";
$password = "Heem8sai";
$dbname = "albertdata_for_hayes";
// Start database connection
// if change to mysqli->connect it won't work -- Hayes
$conn = mysqli_connect($host, $username, $password, $dbname);
// Error if cannot connect
if ($conn->connect_error) {
    die("Cannot connect to database.");
}
//For password reset
$adminemail = 'hayes@cs.uky.edu';
$url = 'http://selab.netlab.uky.edu/forothers/';

/*print "<pre>";
print_r ($_SESSION);
print "</pre>";
*/
?> 

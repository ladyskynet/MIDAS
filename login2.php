<?php
// Albert Kalim
// login.php
// Precondition: user exists and username and password are correct.
// Postcondition: welcome page after successful login.
include 'admin.php';

//session_abort();
//session_start();
/*print "<pre>";
print_r ($_SESSION);
print "</pre>";
*/
//echo "<p>in login2.php</p>";
if(!empty($_POST['username']) && !empty($_POST['password']))
{
$username = $_POST['username'];
$password = md5($_POST['password']);

//echo "<p>username is</p>", $username;
//echo "<p>password is</p>", $password;

//$_SESSION['userid'] = $_POST['username'];

// Check database for the login credentials 
$sql = "SELECT * FROM admin WHERE username='$username' AND password ='$password'";
$result = $conn->query($sql);

//echo "<p>result-num-rows is</p>", $result->num_rows;

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
        $username = $row["username"];	
		session_start();
// Store the login session
      $_SESSION['login'] = $username;
	  header("location:index.php");
    }
}
else {
    echo "<p>Incorrect login. Click the URL below to try to log in again.</p>";
echo '<a href="http://selab.netlab.uky.edu/forothers/login.php">Click here to log in</a>';
}
}
?>


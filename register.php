<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Registration - Admin Only</title>
</head>
<body>
<?php
// Albert Kalim
// register.php
// Precondition: user does not exist and a valid email address.
// Postcondition: user and email address added to the database.
include'admin.php';
if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']))
{
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);

//echo "<p>username is</p>", $username;
//echo "<p>password is</p>", $password;

//Check if username already exists
$sql = "SELECT * FROM admin WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    echo "<h2>Username already exists. Use a different username.</h2>";
 //   echo "<p>username is</p>", $username;
//echo "<p>password is</p>", $password;
}
//If username available then register
else {
	   // echo "<p>username is</p>", $username;
//echo "<p>password is</p>", $password;
$sql = "INSERT INTO admin (email, username, password, firstname,lastname,reset)
VALUES ('$email', '$username', '$password','','','0')";
if ($conn->query($sql) === TRUE) {
    echo "<p>Registration successful. Log in below.</p>";

	header('location:login.php');
} else {
    echo '<h2>Error. Try again.</h2>';
     //   echo "<p>username is</p>", $username;
//echo "<p>password is</p>", $password;
}
$conn->close();
}
}
?>
<form action="" method="post">
<p>Email:<input type="email" name="email" /></p>
<p>Username:<input type="text" name="username" /></p>
<p>Password:<input type="password" name="password" /></p>
<input type="submit" value="Register"/>
</form>
</body>
</html>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<body>
<h3>Login</h3>
<form action="" method="post">
<p>Username:<input type="text" name="username" /></p>
<p>Password:<input type="password" name="password" /></p>
<input type="submit" value="Login"/><br><br>
<a href="reset.php">Forgot Password?</a> | <a href="register.php">Register</a>
</form>
</body>
</html>
<?php
// Albert Kalim
// login.php
// Precondition: user exists and username and password are correct.
// Postcondition: welcome page after successful login.
include 'admin.php';

//session_abort();
//session_start();
print "<pre>";
print_r ($_SESSION);
print "</pre>";


if(!empty($_POST['username']) && !empty($_POST['password']))
{
$username = $_POST['username'];
$password = md5($_POST['password']);

//$_SESSION['userid'] = $_POST['username'];

// Check database for the login credentials 
$sql = "SELECT * FROM admin WHERE username='$username' AND password ='$password'";
$result = $conn->query($sql);
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
    echo "<p>Incorrect login. Try again below.</p>";
}
}
?>


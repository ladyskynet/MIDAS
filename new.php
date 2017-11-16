<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Reset</title>
</head>
<body>
<?php
// Albert Kalim
// new.php
// Precondition: user exists and forgot password link clicked. Also, user has received a password reset email and clicked on the URL in the email.
// Postcondition: password updated in the database.
include ('admin.php');
if(!empty($_GET['reset']) && !empty($_GET['user']))
{
$reset = $_GET['reset'];
$username = $_GET['user'];
// Check database for login credentials
$sql = "SELECT * FROM admin WHERE reset='".$reset."' AND username='".$username."'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
if(!empty($_POST['password']))
{
$password = md5($_POST['password']);
$sql = "UPDATE admin SET password='$password' WHERE username = '$username'";
if ($conn->query($sql) === TRUE) {
	header('location:login.php');
} else {
    echo "<h2>Error. Try again.</h2>";
}
$conn->close();
}
?>
<div id="form">
<h3>Enter A New Password Below</h3>
<form id="install" action="" method="post">
<p>New password:<input type="password" name="password" /></p>
<input type="submit" value="Reset password"/>
</form>
</div>
<?php
}
else {
    echo "<p>Error. Try again.</p>";
}
}
else {
	header('location:index.php');
}
?>
</body>
</html>

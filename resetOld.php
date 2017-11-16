<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
</head>
<body>
<h3>Reset Your Password</h3>
<form action="" method="post">
<br>Username: <input type="text" name="username" /><br><br>
<input type="submit" value="Send me email"/><br><br>

<a href="register.php">Register</a>

</form>
</body>
</html>
<?php
// Albert Kalim
// reset.php
// Precondition: username exists and email valid.
// Postcondition: password reset email sent.
include ('admin.php');
if(!empty($_POST['username']))
{
$username = $_POST['username'];
$key = date('YHis');
//Check database for data correctness
$sql = "SELECT * FROM admin WHERE username='".$username."'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
	$email = $row['email'];
	}
//if username matches create key using php date and send password reset email
	$sql = "UPDATE admin SET reset='$key' WHERE username ='".$username."'";
if ($conn->query($sql) === TRUE) {
	$message = 'Click or copy the following link and paste it onto your browser to reset your password '.$url.'new.php?user='.$username.'&reset='.$key.'';
	$header = "From: $adminemail";
    mail($email,'Password Reset Request',$message,$header);
	echo 'Email sent. Check your inbox/junkbox now and close this page.';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else {
    echo "User not found. Try again, register below or email admin at akalim2@netlab.uky.edu for assistance.";
}
$conn->close();
}
else {
	echo "Enter your username below and click Send me email button below.";
}
?>


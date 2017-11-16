<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Registration</title>
</head>
<body>
<h3>Register For An Account - Web-Based Trace Data Set Consensus Builder</h3>
<script type="text/javascript">
// var RecaptchaOptions = {
//    theme : 'clean' }; 
</script>

<form action="verify.php" method="post">
<p>First Name:<input type="text" name="firstname" required/></p>
<p>Last Name:<input type="text" name="lastname" required/></p>
<p>Email:<input type="email" name="email" required/></p>
<p>Username:<input type="text" name="username" required/></p>
<p>Password:<input type="password" name="password" required/></p>
<?php
//     require_once('recaptchalib.php');
//     $publickey = "6LfAgxQTAAAAAO8WHLGLaJuM1ApxgXq5aVFNSAIy"; // you got this from the signup page
//     echo recaptcha_get_html($publickey);
?>

<input type="submit" value="Submit registration"/>
</form>
</body>
</html>

<?php
// Albert Kalim
// register.php
// Precondition: user does not exist and a valid email address.
// Postcondition: user and email address added to the database.
include 'admin.php';
if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']))
{
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);
//Check if username already exists
$sql = "SELECT * FROM admin WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    echo "<h2>Username already exists. Use a different username.</h2>";
}
//If username available then register
else {
$sql = "INSERT INTO admin (firstname, lastname, email, username, password)
VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "<p>Registration successful. <a href=\"login.php\">Click here</a> to log in.</p>";
        //header('location:login.php');
} else {
    echo '<p>Error. Go back and try again.</p>';
}
$conn->close();
}
}
?>


<?php
// Albert Kalim
// verify.php
// Precondition: user fills out the registration fields (email, username, password) in the registration page and enters a captcha verification
// Postcondition: registration successful (user and email address added to the database) and redirecting to the login page or an incorrect captcha was entered and an error message pops up. 

// require_once('recaptchalib.php');
// $privatekey = "6LfAgxQTAAAAAIXQGWest0MM3OpSpiN4sbJuBmbg";
// $resp = recaptcha_check_answer ($privatekey,
//                                 $_SERVER["REMOTE_ADDR"],
//                                 $_POST["recaptcha_challenge_field"],
//
//                                 $_POST["recaptcha_response_field"]);
// if (!$resp->is_valid) {
   // What happens when the CAPTCHA was entered incorrectly
//   die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
//        "(reCAPTCHA said: " . $resp->error . ")");
// } else {

include'admin.php';

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
    echo "<p>Username already exists. Use different email and username.</p>";
}
//If username available then register
else {
$sql = "INSERT INTO admin (firstname, lastname, email, username, password)
VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "<p>Registration successful. Log in below or you will be redirected to the login screen in few seconds.</p>";
echo '<a href="http://selab.netlab.uky.edu/forothers/login.php">Click here to log in</a>';
header( "refresh:5;url=login.php" );

} else {
    echo '<p>Error. Try again.</p>';
}
$conn->close();
}
}

 }
 ?>

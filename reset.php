<?php
print "<pre>";
print_r ($_SESSION);
print "</pre>";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
</head>
<body>
<h3>Reset Your Password - Web-Based Trace Data Set Consensus Builder</h3>

<p>Enter your <b>username</b> below and click the "Send me email" button below. If you do not remember your username, please email akalim2@netlab.uky.edu for assistance.

<form action="reset2.php" method="post" >
<br>Username: <input type="text" name="username" required/><br><br>
<input type="submit" value="Send me email" name="resetMe"/><br><br>

<!--<a href="register.php">Register</a>-->

</form>
</body>
</html>


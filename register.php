<?php 
include "admin.php";
//session_abort();
session_start();
 
 //echo "in addData";

//print "<pre>";
//print_r ($_SESSION);
//print "</pre>";

//if (isset($_POST['AddData'])) {
//	$_SESSION['dname'] = $_POST['dset_name'];
//}
//echo $_SESSION['dname'];

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Account Registration - Admin Only</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
		<div id="wrapper">
			<!-- Header -->
			<header id="header">
				<div class="inner">
					<!-- Logo -->
					<a href="index.html" class="logo">
						<span class="symbol"><img src="images/goldstack.png" alt="" /></span><span class="title">Midas</span>
					</a>
					<!-- Nav -->
					<nav>
						<ul>
							<li><a href="#menu">Menu</a></li>
						</ul>
					</nav>
				</div>
			</header>

			<!-- Menu -->
			<nav id="menu">
				<h2>Menu</h2>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="addData.php">Upload New Set</a></li>
					<li><a href="dlist.php">View All Sets</a></li>
					<li><a href="average-votes.php">View All Averages</a></li>
					<li><a href="delete.php">Manage All Sets</a></li>
				</ul>
			</nav>

			<!-- Main -->
			<div id="main">
				<div class="inner">
					<?php include "logout.php"; ?>
					
					<h1>Upload Your Data Set</h1>

					<!-- Form -->
					<section>
						<h3>Enter your data set name and click next to upload the zip file.</h3>
						<form action="" method="post" enctype="multipart/form-data">
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<label for="email">Email</label>
									<input type="email" name="email" />
									<label for="username">Username</label>
									<input type="text" name="username" />
									<label for="password">Password</label>
									<input type="password" name="password" />
								</div>
								
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Register"/></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>
	</body>
</html>

<?php
// Albert Kalim
// register.php
// Precondition: user does not exist and a valid email address.
// Postcondition: user and email address added to the database.
include'admin.php';
if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])){
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
 		// echo "<p>username is</p>", $username;
		// echo "<p>password is</p>", $password;
	} else {
		//If username available then register
		// echo "<p>username is</p>", $username;
		//echo "<p>password is</p>", $password;
		$sql = "INSERT INTO admin (email, username, password, firstname,lastname,reset) VALUES ('$email', '$username', '$password','','','0')";
		if ($conn->query($sql) === TRUE) {
    		echo "<p>Registration successful. Log in below.</p>";
    		header('location:login.php');
		} else {
    		echo '<h2>Error. Try again.</h2>';
     		// echo "<p>username is</p>", $username;
			// echo "<p>password is</p>", $password;
		}
		$conn->close();
	}
}
?>
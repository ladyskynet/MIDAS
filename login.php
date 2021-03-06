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
		<title>Add Data</title>
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
					<h1>Login - Multi-user Input in Determining Answer Sets (MIDAS)</h1>

					<!-- Form -->
					<section>
							
						</form>
						<form action="login2.php" method="post" enctype="multipart/form-data">
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<label for="username">Username</label>
									<input type="text" name="username" required/></p>
									<label for="password">Password</label>
									<input type="password" name="password" required/></p>
								</div>
								
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Login" class="special"/></li>
										<li><a href="reset.php">Forgot Password?</a></li>
										<li><a href="register.php">Register</a></li>
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
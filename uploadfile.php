<?php
session_start();
/*
print "<pre>";
print_r($_SESSION);
print "</pre>";
*/
//GET USERID FROM SESSION
$user_id = $_SESSION['login'];
?> 
<!DOCTYPE HTML>
<html>
	<head>
		<title>Upload File</title>
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
					
					<h1>Select the zip file to upload</h1>
					<h3>Click Browse to select the file and hit Upload button.</h3>
					<body>
						<!-- Form -->
						<section>
							<h2>Form</h2>
							<p>Enter your data set name and click next to upload the zip file.</p>
							<form action="uploadNow.php" method="post" enctype="multipart/form-data">
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<input type="file" name="fileToUpload" id="fileToUpload" required>
								</div>
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Upload" name="submit" class="special"></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
					</body>
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
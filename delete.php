<?php

include "logout.php";
include "admin.php";

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
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Delete</title>
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
					<h1>List of your Datasets:</h1>
					<body>
						<section>
							<div class="row">
								<div class="6u 12u$(medium)">
									<ul class="alt">
										<?php
											$sql = "SELECT * from datasets where userid='$user_id'";
											$result = $conn->query($sql);
											if ($result->num_rows > 0){
        										while($row = $result->fetch_assoc()) {
													//	print "<pre>"; print_r ($row); print "</pre>";?>
													<li><a href="deleteNow.php?name=<?php echo $row['name']?>&did=<?php echo $row['id']?>&fdir=<?php echo $row['filedirectory']?>&fdir2=<?php echo $row['fdir2']?>"><?php echo $row['name'];?></a></li>
													<?php
												}
												print "</ul>";
											}
											else {
												echo "You have no available data set"; 
												//echo "failed to do sql call";
											}
											if ($conn->query($sql) == TRUE) {
											// Take them to uploadfile.php
											// echo "New record created successfully";
											} else {
												echo "Error: " . $sql . "<br>" . $conn->error;
											}
										?>
									<!--</ul>-->
								</div>
							</div>
						</section>
					</body>
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
	$conn->close();
?>
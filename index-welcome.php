<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
session_start();
?>
<!--User Logged In-->
<html>
	<head>
		<title>Midas</title>
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
					<h2><?php include "logout.php";?></h2>
					<h3>Login successful. Welcome!</h3>
					<!-- Logo -->
					<a href="index.php" class="logo">
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
					<header>
						<h1>Midas is Multi-user Input in Determining Answer Sets.<br></h1> 
							<p>It is a centralized, web-based tool for capturing community opinion on answer sets (or gold standards) for datasets used for empirical research. It is currently focused on traceability datasets. The tool supports many users at a time. It provides a visual representation of the data sets and the answer sets and currently allows users to vote, comment, and view status of answer set elements.</p>
					</header>
					
					<section class="tiles">
						<article class="style1">
							<span class="image">
								<img src="images/pic01.jpg" alt="" />
							</span>
							<a href="addData.php">
								<h2>Upload</h2>
								<div class="content">
									<p>Click here to upload your zip file (read the instructions below first before uploading your file!)</p>
								</div>
							</a>
						</article>
						<article class="style2">
							<span class="image">
								<img src="images/pic02.jpg" alt="" />
							</span>
							<a href="dlist.php">
								<h2>View Sets</h2>
								<div class="content">
									<p>Click here to see the uploaded data sets</p>
								</div>
							</a>
						</article>
						<article class="style3">
							<span class="image">
								<img src="images/pic03.jpg" alt="" />
							</span>
							<a href="average-votes.php">
								<h2>View Averages</h2>
								<div class="content">
									<p>Click here to average the votes on current data set</p>
								</div>
							</a>
						</article>
						<article class="style4">
							<span class="image">
								<img src="images/pic04.jpg" alt="" />
							</span>
							<a href="delete.php">
								<h2>Manage Sets</h2>
								<div class="content">
									<p>Click here to delete your data sets</p>
								</div>
							</a>
						</article>
					</section>
					<br>
					<section>
						<h2>Info</h2>
						<h3>Steps to Zip/Naming Convention</h3>
						<ol>
							<li>Create a new folder and add the project name as the name of the folder/file.</li>
							<li>Create two new folders inside the project folder and name them "high" and "low".</li>
							<li>Add individual source items/text files into the "high" folder and target items/text files into the "low" folder. Make sure each file is a .txt file.</li>
							<li>Add the answer set file "results.txt" into the project folder. Make sure this file contains the trace links in certain format and that it is a .txt file.</li>
							<li>Zip the folder and make sure the name of the zip file matches the project folder name. You are ready to upload the zip file.</li>
						</ol>
							<p>See an example below and <a href="http://selab.netlab.uky.edu/forothers/projectsample/">click here for a sample zip file</a>.<br><br><img src="http://selab.netlab.uky.edu/forothers/zip2.jpg"></p>
					</section>';?>
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
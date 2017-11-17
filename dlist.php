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
		<title>Data Set List</title>
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
					<?php include "admin.php"; ?>
					
					<h1>List of your Datasets, click to view/vote:</h1>
					<body>
						<section>
							<div class="row">
								<div class="6u 12u$(medium)">
									<ul class="alt">
										<?php
											//Hayes commented out below statement in favor of one on line 28
											//$sql = "SELECT * from Datasets";
											$sql = "SELECT * from datasets where userid='$user_id'";
											$result = $conn->query($sql);
											if ($result->num_rows > 0){
        										while($row = $result->fetch_assoc()) {
													//	print "<pre>"; print_r ($row); print "</pre>";
        											?>
													<li><a href="displayfile.php?name=dname&did=<?php echo $row['id']?>&fdir=<?php echo $row['filedirectory']?>&fdir2=<?php echo $row['fdir2']?>&dname=<?php echo $row['name']?>"><?php echo $row['name']?></a></li>
													<?php
													//$did = $row["id"];
													//$_SESSION['did'] = $did;
    											}
											}
											else {
												echo "failed to do sql call";
											}

											if ($conn->query($sql) == TRUE) {
												// Take them to uploadfile.php
												// echo "New record created successfully";
											} else {
    											echo "Error: " . $sql . "<br>" . $conn->error;
											}

											$conn->close();
										?>
									</ul>
								</div>
							</div>
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
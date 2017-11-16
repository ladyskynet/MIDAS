<?php

include "logout.php";
include "admin.php";

session_start();

$did = $_GET['did'];
/*
$user_id = $_SESSION['login'];
$dset_name = $_SESSION['dname'];
$fdir2 = $_GET['fdir2'];
$fdir = $_GET['fdir'];
*/
//print "<pre>"; print_r ($_SESSION); print "</pre>";

$sql1 = "Delete from datasets where id='$did'";
				if ($conn->query($sql1) == TRUE) {
					header ("location: dlist.php");
				} else {
    					echo "unable to insert";
				}		


?>


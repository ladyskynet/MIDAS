<?php include "logout.php"; ?>
<!DOCTYPE html>
<html>
<body>
<h3>Upload your zip file</h3>

<p>Enter your data set name and click next to upload the zip file.</p>
<form action="addDataNow.php" method="post" enctype="multipart/form-data">

<p>Data Set Name: <input type="text" name="dset_name" required></p>
    <input type="submit" value="Next" name="addName">
 </form>

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
</body>
</html>

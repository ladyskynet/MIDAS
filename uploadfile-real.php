<?php
include "logout.php";
?>
<!DOCTYPE html>
<html>
<body>
<h3>Select the zip file to upload</h3>
<p>Click Browse to select the file and hit Upload button.</p>
<?php

session_start();
/*
print "<pre>";
print_r ($_SESSION);
print "</pre>";
*/
//echo "<p>inside uploadfile.php</p>";
//echo "dname is ", $_SESSION['dname'];
//echo "login is ", $_SESSION['login'];
?>

<form action="uploadNow.php" method="post" enctype="multipart/form-data">

<!--
<p>Dataset Name: <input type="text" name="dset_name"></p>
-->
<p>	  Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload" name="submit">
</p>
 </form>

</body>
</html>

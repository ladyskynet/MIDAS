<?php
// Albert Kalim
// index.php
// Precondition: None. 
// Postcondition: clicking on the login link will take the user to the login page. Upon a successful login, user will see the welcome/landing page and the option to log out.
/*

*/
//include "logout.php";
session_start();
//print "<pre>";
//print_r ($_SESSION);
//print "</pre>";
if (isset($_SESSION['login'])){


?>
<!--User Logged In-->
 

<h2>
<?php
include "logout.php";
?></h2>

<h3>Login successful. Welcome!</h3>

<h2><a href="addData.php">Click here to upload your zip file <b><u><i>(read the instructions below first before uploading your file!)</a></i></u></b></h2>
<p><b style="color:red;"><i><u>How to zip your file and the naming convention to follow:</u></b></i> 
<br>1. Create a new folder and add the project name as the name of the folder/file.<br>
2. Create two new folders inside the project folder and name them "high" and "low".<br> 
3. Add individual source items/text files into the "high" folder and target items/text files into the "low" folder. Make sure each file is a .txt file.<br>
4. Add the answer set file "results.txt" into the project folder. Make sure this file contains the trace links in certain format and that it is a .txt file.<br>
5. Zip the folder and make sure the name of the zip file matches the project folder name. You are ready to upload the zip file.<br>
<br>
See an example below and <a href="http://selab.netlab.uky.edu/forothers/projectsample/">click here for a sample zip file</a>.<br><br><img src="http://selab.netlab.uky.edu/forothers/zip2.jpg"></p>




<h2><a href="dlist.php">Click here to see the uploaded data sets</a></h2>
<h2><a href="delete.php">Click here to delete your data sets</a></h2>
<h2><a href="average-votes.php">Click here to average the votes on current data set</a></h2>


<?php

}
else{
?>

<p><br><img src="http://selab.netlab.uky.edu/forothers/gold.jpg"></p>
<h3>Multi-user Input in Determining Answer Sets (MIDAS)</h3>

<p>Multi-user Input in Determining Answer Sets (MIDAS) is a centralized, web-based tool for capturing community opinion on answer sets (or gold standards) for datasets used for empirical research.  It is currently focused on traceability datasets.  The tool supports many users at a time. It provides a visual representation of the data sets and the answer sets and currently allows users to vote, comment, and view status of answer set elements.</p>



<p><a href="login.php">Click here to log in</a></p>
<?php
}
?>
</body>
</html>

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
<html>
<head>
<title></title>
</head>

<body>
<p>List of your Datasets:</p>
<ul>

<?php
$sql = "SELECT * from datasets where userid='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
//	print "<pre>"; print_r ($row); print "</pre>";
        ?>
	<li><a href="deleteNow.php?name=<?php echo $row['name']?>&did=<?php echo $row['id']?>&fdir=<?php echo $row['filedirectory']?>&fdir2=<?php echo $row['fdir2']?>"><?php echo $row['name']?></a></li>
	<?php
    }
print "</ul>";
}
else {
	echo "You have no available data set"; 
	//echo "failed to do sql call";
}




if ($conn->query($sql) == TRUE) {
	//TAke them to uploadfile.php
//    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>

</ul>
</body>
</html>


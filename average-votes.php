<?php

include "logout.php";
include "admin.php";
echo '<link href="table.css" rel="stylesheet">';

session_start();


//GET USERID FROM SESSION
$user_id = $_SESSION['login'];
?> 
<html>
<head>
<title></title>
</head>

<body>
<p>Average of the votes for all links in data set:</p>
<ul>

<?php

//echo " in average-votes.php ";

$sql = "SELECT targetid, Sourceid, vote, count(*), (COUNT(*)/(SELECT COUNT(*) FROM votes)) * 100 FROM votes group by targetid, Sourceid, vote";



$result = $conn->query($sql);
if ($result->num_rows > 0){
	//echo " num_rows > 0 ";
	//echo "just before the while ";
	//print "</ul>";


	?>
<table border = "1">
<COLGROUP>
   <COL align="center" width ="30" span="3">
   <COL width="30">
   <COL width="40">
   <COL width="30">
   <COL width="30">
  <thead>
    <tr>
	 <th>TargetID</th>
	 <th>SourceID</th>
     <th>Vote</th>
     <th>Count</th>
     <th>Percentage</th>
    </tr>
    <br/>
  </thead>
 

<br/>
 <?php
 while($row = $result->fetch_assoc()) {
 	//echo " inside while ";
 	//print_r ($row.[1]); print_r ($row.[2]); print_r($row.[3]);
 	  $data .= "<tr>
                    <td>" . $row['targetid'] . "</td>
                    <td>" . $row['Sourceid'] . "</td>
                    <td>" . $row['vote'] . "</td>
                    <td>" . $row['count(*)'] . "</td>
                    <td>" . $row['(COUNT(*)/(SELECT COUNT(*) FROM votes)) * 100'] . "</td>
                    <ul> </ul>
                  </tr>";
     }}

     ?>
<form>
    <?= $data ?>
</form>
</table> 

<?php
 //print "<pre>"; print_r ($row); print "</pre>";}}
 
      
    

//print "</ul>";
//}
//else {
//	echo "You have no available data set"; 
	//echo "failed to do sql call";
//}

$conn->close();


?>

</ul>
</body>
</html>


<?php

include "logout.php";
include "admin.php";
echo '<link href="table-2.css" rel="stylesheet">';

session_start();


//GET USERID FROM SESSION
$user_id = $_SESSION['login'];
?> 
<html>
<head>
<title></title>
</head>

<body>
<p>Average of the votes for all answer set pairs:</p>
<ul>

<?php

//echo " in average-votes.php ";

//$sql = "SELECT targetid, Sourceid, vote, count(*), (COUNT(*)/(SELECT COUNT(*) FROM votes)) * 100 FROM votes group by targetid, Sourceid, vote";
$sql = "SELECT v1.TargetID as target, v1.SourceID as source, v1.vote, v1.vote_count, (v1.vote_count/v2.all_count)*100 as percentage 
FROM 
(SELECT TargetID, SourceID, vote, COUNT(vote) as vote_count FROM votes GROUP BY TargetID, SourceID, vote) as v1
INNER JOIN
(SELECT TargetID, SourceID, COUNT(*) as all_count FROM votes GROUP BY TargetID, SourceID) as v2
ON 
v1.TargetID LIKE v2.TargetID
AND v1.SourceID LIKE v2.SourceID";

$result = $conn->query($sql);
if ($result->num_rows > 0){
	//echo " num_rows > 0 ";
	//echo "just before the while ";
	//print "</ul>";


	?>
<table border = "1">
<COLGROUP>
   <COL width="10">
   <COL width="10">
   <COL width="10">
   <COL width="10">
   <COL width="10">
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
                    <td>" . $row['target'] . "</td>
                    <td>" . $row['source'] . "</td>
                    <td>" . $row['vote'] . "</td>
                    <td>" . $row['vote_count'] . "</td>
                    <td>" . $row['percentage'] . "</td>
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

// this is what i zapped out of final column
//(COUNT(*)/(SELECT COUNT(*) FROM votes)) * 100

$conn->close();


?>

</ul>
</body>
</html>


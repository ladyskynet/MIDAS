<?php

include "logout.php";
include "admin.php";

session_start();


// GET USERID FROM SESSION
$user_id = $_SESSION['login'];
?> 
<html>
<head>
<title>Average</title>
</head>

<body>
<p>Average of the votes for all links in dataset:</p>
<ul>

<?php

echo " in average-votes.php ";

$sql = "SELECT targetid, Sourceid, vote, count(*), (COUNT(*)/(SELECT COUNT(*) FROM votes)) * 100 FROM votes group by targetid, Sourceid, vote";

$result = $conn->query($sql);
if ($result->num_rows > 0){
	echo " num_rows > 0 ";
	echo "just before the while ";
	print "</ul>";
	echo "TargetID       ",  "SourceID       ",    "vote     ",    "count  ",     "percentage    ";
 while($row = $result->fetch_assoc()) {
 	//echo " inside while ";
 	//print_r ($row.[1]); print_r ($row.[2]); print_r($row.[3]);
 	  $data .= "<table>  
                <thead>
                  <tr>
                    <td> TargetID </td>
                    <td> SourceID </td>
                    <td> Vote </td>
                    <td> Count </td>
                    <td> Percentage </td>
                  </tr>
                </thead>
                <tbody>  
                  <tr>
                    <td>" . $row['targetid'] . "</td>
                    <td>" . $row['Sourceid'] . "</td>
                    <td>" . $row['vote'] . "</td>
                    <td>" . $row['count(*)'] . "</td>
                    <td>" . $row['(COUNT(*)/(SELECT COUNT(*) FROM votes)) * 100'] . "</td>
                    <ul> </ul>
                  </tr>
                </tbody>
              </table>";
     }}

     ?>
<form>
    <?= $data ?>
</form>

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



<script type="text/javascript">
function showTarget(str, did) {
    if (str == "") {
        document.getElementById("hello").innerHTML = "";
        return;
    } else {
//	alert (str);
	
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
    } else {
            // code for IE6, IE5
      xmlhttp = new ActiveXObject();
 }
        xmlhttp.onreadystatechange = function() {
           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("hello").innerHTML = xmlhttp.responseText;
           }
        };
        xmlhttp.open("GET","displayfile.php?ename="+str+"&theid="+did,true);
        xmlhttp.send();
    }
}


function showDes(str2, did2, sid) {
//	alert (str2);
//	alert (did2);
//	alert(sid);
    if (str2 == "") {
        document.getElementById("des").innerHTML = "";
        return;
    } else {
	
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
          newOne = new XMLHttpRequest();
    } else {
            // code for IE6, IE5
      newOne = new ActiveXObject();
 }
        newOne.onreadystatechange = function() {
           if (newOne.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("des").innerHTML = newOne.responseText;
          }
        };
        newOne.open("GET","displayfile.php?describ="+str2+"&theid="+did2+"&sid="+sid,true);
        newOne.send();
    }
}

</script>

<?php
include "admin.php";
session_start();

$user_id = $_SESSION['login'];
//print "user id is ".$user_id;

$dir = MYFILES;
/*
print "<pre>";
print_r ($_SESSION);
print "</pre>";
*/
//if (isset($_GET['name'])) {
   $did = $_GET['did'];
   $owner_dir = $_GET['fdir'];
   $_SESSION['fdir'] = $owner_dir;

   $fdir2 = $_GET['fdir2'];
   $_SESSION['fdir2'] = $fdir2;

   //$owner_dir = 'test';
   $source_dir = $dir."/".$owner_dir."/".$fdir2."/high";
//   print $source_dir;
   $target_dir = $dir."/".$owner_dir."/".$fdir2."/low";
//Hayes added line below
   //echo " at line 82 of displayfile, just got source and target directory, which are  ",$source_dir," ",$target_dir, " ";

//Hayes replaced line 85 with line 86
if (isset($_GET['ename'])) {
  // if (true) {
		$s_id = $_GET['ename'];

		//Hayes added two lines below
		//$sid = $s_id;
		//echo " at line 88 and the sid has value of, which is GET['ename'] ",$sid;

		$did = $_GET['theid'];
		
		//hayes added line below
		//echo "at line 89 of displayfile ";

		print "<div id='source_m' style='display:block;width:78%;float:right'>";
		$did2 = $did;
		$sid = $s_id;
		//print "<br>sid is ".$sid;
		//print "<br>did is ".$did2;

// Hayes added line below
		 //echo " at line 97, and did2 = ", $did2;

		$x = "select * from datasets where id= '$did2'";
		
		print "<h3>Source: ".$sid."</h3>";
		$res = $conn->query($x);
		if ($res->num_rows > 0) {

//Hayes added below line
			//echo " inside if statement line 102 but before while -- meaning num-rows > 0 ";

			while($row = $res->fetch_assoc()) {
			//	print_r ($row);
				$theS = MYFILES.$row['filedirectory']."/".$row['fdir2']."/high/".$sid;
		//		print "<br>".$theS;
				$myf = $row['filedirectory'];
				$myf2 = $row['fdir2'];
		
				print file_get_contents($theS);
				
		$nameX = $row['name'];
	  }
		
	}
		print "</div><div style='clear: both'></div>";
		print "<div id='t_item' style='border-right:1px solid #999;width:20%;float:left;'>";

		//$did = '101';
		$the_target = "select target from source_target2 where source = '".$s_id."' and did='".$did."'";
		$res = $conn->query($the_target);
		if ($res->num_rows > 0) {
			//print "<div id='hello'><h3>Target Items</h3><ul>";
			while($row = $res->fetch_assoc()) {
				//print "HIIIIIIII<pre>"; print_r ($row['target']); print "</pre>";
				if ($row['target'] != '') {
					print "<h3>Click on target item to vote</h3><ul>";
					print "<h4>Target Items</h4><ul>";
					$m = explode(';', $row['target']);
		//			print_r ($m);
					foreach ($m as $key) {
						$n = strstr($key, '.txt', TRUE);
						//print $n;			
            					//echo '<li value='.$n.'>'.$n.'</li>';
            					echo '<li value='.$n.' onClick="showDes(\''.$key.'\', '.$did.', \''.$s_id.'\')">'.$n.'</li>';
            					//echo '<p value='.$row['source'].' onClick="showTarget(\''.$row['source'].'\', '.$did.')">'.$s.'</p>';
            					//echo '<li value='$n' onClick="showDes(\''.$n.'\', '.$did.')">'.$n.'</li>';
            					//print "<li><a href='displayfile.php?tname=".$n."'>".$n."</a></li>";
					}
				print "</ul>";
				}
				else {
					print "<h4>No Target Item</h4>";
				}
			}

		$countS = "select count(source) as count1 from source_target2 where did='".$did."'";
		$res = $conn->query($countS);
		if ($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				$count1 = $row['count1'];
					
			}
		}
		
		$countT = "select target from source_target2 where did='".$did."'";
		$res = $conn->query($countT);
		$a = 0;
		if ($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				$s=explode(';', $row['target']);
				//print "<pre>"; print_r ($s); print "</pre>";
				foreach ($s as $key) {
					if ($key != '') {
						$a++;
					}
				}
			}
		}

		//$theR = MYFILES.$row['filedirectory']."/".$row['fdir2']."/low/".$sid."/*";
		$theR = MYFILES.$myf."/".$myf2."/low";
		//print $theR;
		$fc=0;
		foreach (scandir($theR) as $entry) {
			if (!is_dir($entry)){ 
				$fc++;
		}	
		}
		//$q = (count(scandir($theR))-2);
		


		//count(glob($theR,GLOB_BRACE));

			Print "<table>";
			print "<th>Data Set Properties</th>";
			print "<tr><td>Name </td><td> ".$nameX."</td></tr>";
			print "<tr><td>Source Items </td><td> ".$count1."</td></tr>";
			print "<tr><td>Target Items </td><td> ".$fc."</td></tr>";
			print "<tr><td>Links </td><td> ".$a."</td></tr>";
			print "</table>";
		}
  		
		print "</div></div>";
}
//))))
//))))  0     

elseif (isset($_GET['describ'])) {
 		print "<div style='width:78%;float:right;padding-bottom:11px;'>";
		$t_id = $_GET['describ'];
		//print "<br>tid is ".$t_id;
		$did2 = $_GET['theid'];
		$sid = $_GET['sid'];
		//print "<br>sid is ".$sid;
		$x = "select * from datasets where id= '$did2'";
		$res = $conn->query($x);
		if ($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				//print_r ($row);
				$theS = MYFILES.$row['filedirectory']."/".$row['fdir2']."/high/".$sid;
				$theT = MYFILES.$row['filedirectory']."/".$row['fdir2']."/low/".$t_id;
		//		print "<br>".$theS;
		//		print "<br>".$theT;

/*			
				print "<h3>Source: ".$sid."</h3>";
				print file_get_contents($theS);
*/				

				print "<h3>Target: " .$t_id."</h3>";
				print file_get_contents($theT);

	
				print "<h3>Vote:</h3>";
				print " <form action=''  method='POST'>
				<input type='radio' name='vote1' value='black' checked >Link (black)<br>
				<input type='radio' name='vote1' value='white'>Not a link (white)<br>
				<input type='radio' name='vote1' value='gray'>Possible link (gray)<br><br>
				<input type='hidden' name='sid' value='$sid'>
				<input type='hidden' name='tid' value='$t_id'>";
				print "<h3>Comments</h3>";
				print "<textarea style='width:500px; height:100px;' name='theComment'></textarea>";
            				//echo '<li value='.$n.' onClick="showDes(\''.$key.'\', '.$did.', \''.$s_id.'\')">'.$n.'</li>';
				print "<p><input type='submit' name='submit1' value='Submit Vote/Comment'>";
				print "</form>";


				//display vote results
				print "<h3>Voting Summary</h3>";
				print "<table>";
				
				//count votes	
				$b = "select count(*) as black from votes where datasetid= '$did2' and Sourceid='$sid' and Targetid='$t_id' and vote='black'";
				$resb = $conn->query($b);
				if ($resb->num_rows > 0) {
					while($row = $resb->fetch_assoc()) {
						//print_r ($row['black']);
						print "<tr><td>Link (black)	    </td><td>:  ".$row['black']."</td></tr>";
					}
   				} else {	
					echo "failed to do sql call";
   				}
			
				$x = "select count(*) as white from votes where datasetid= '$did2' and Sourceid='$sid' and Targetid='$t_id' and vote='white'";
				//print $x;
				$res = $conn->query($x);
				if ($res->num_rows > 0) {
					while($row = $res->fetch_assoc()) {
						//print_r ($row['white']);
						print "<tr><td>Not a link (white) </td><td>:  ".$row['white']."</td></tr>";
					}
   				} else {	
					echo "failed to do sql call";
   				}
			
				$x = "select count(*) as gray from votes where datasetid= '$did2' and Sourceid='$sid' and Targetid='$t_id' and vote='gray'";
				$res = $conn->query($x);
				if ($res->num_rows > 0) {
					while($row = $res->fetch_assoc()) {
						//print_r ($row['gray']);
						print "<tr><td>Possible link (gray)</td><td>: ".$row['gray']."</td></tr>";
					}
   				} else {	
					echo "failed to do sql call";
   				}
			
				$x = "select count(*) as total from votes where datasetid= '$did2' and Sourceid='$sid' and Targetid='$t_id'";
				$res = $conn->query($x);
				if ($res->num_rows > 0) {
					while($row = $res->fetch_assoc()) {
						//print_r ($row['total']);
						print "<tr><td>Total number of votes </td><td>:	".$row['total']."</td></tr>";
					}
   				} else {	
					echo "failed to do sql call";
   				}
				print "</table>";


				$x = "select * from Dcomment, admin where Dcomment.Did= '$did2' and admin.username=Dcomment.Userid and Dcomment.Sourceid='$sid' and Dcomment.Targetid='$t_id'";
				//print $x;
				$res = $conn->query($x);
				if ($res->num_rows > 0) {
					print "<h3>Comments added</h3>";
					while($row = $res->fetch_assoc()) {
				//		print_r ($row);
						$his = date('F j , Y', strtotime($row['historylog']));
						print "<p>".$row['Comments']." <i>-- by ".$row['firstname']."   ".$row['lastname']." on ".$his."</i></p>";
					}
   				} else {	
//					echo "failed to do sql call";
   				}
			
//);
			}

			print "</div>";
		}
	  }
   
else {

include "logout.php";

	$dname = $_GET['dname'];
   print "<div id='main' style='border-left: 1px solid #999;border-right:1px solid #999; border-top:1px solid #999;width:98%;padding:15px;height: 800px;'>";

// Open a directory, and read its contents
   if (is_dir($dir)){
       if ($dh = opendir($dir)){
          print "<div id='leftpart' style='width:20%;float:left;border-right: 1px solid #999;'>";
       //    while (($file = readdir($dh)) !== false){

           if (is_dir($source_dir)) { //print sources in high dir
		//print "high exists";
		if ($source = opendir($source_dir)) {
			//print "<h3>Source Items</h3><ul name="mysource" onClick="showTarget(this.value)">";
			print "<h3>Click on source item to see linking target items</h3><ul>";
			print "<h2>$dname</h2><h4>Source Items</h4><ul>";
			//Hayes added debug line below
			//echo "still at line 320, the did being searched for in source_target2 is ", $did;

			//print "<h3>Source Items</h3><ul name='mysource' onClick='showTarget(\''.$row['source'].'\')'>";
			//print "<h3>Source Items</h3><ul name='mysource' onClick='showTarget(this.value)'>";
   
			$sql = "SELECT * from source_target2 where did='$did'";

			//$slist = array()o
   			$result = $conn->query($sql);
   			if ($result->num_rows > 0){
        			while($row = $result->fetch_assoc()) {
//	    				print "<pre>"; print_r ($row); print "</pre>";
	   			        $s = strstr($row['source'], '.txt', TRUE);
 //           				print "<li value=".$s."><a href='displayfile.php?sname=".$row['source']."&did=".$did."'>".$s."</a></li>";
            	//			echo '<li value='.$row['source'].' onClick="showTarget(\''.$row['source'].'\', '.$did.')">'.$s.'</li>';
            				echo '<li value='.$row['source'].' onClick="showTarget(\''.$row['source'].'\', '.$did.')">'.$s.'</li>';
           				//print "<li value=".$row['source'].">".$s."</li>";
            				//print "<li value=".$row['source'].">".$s."</li>";
        			}
   			} else {	
				echo "failed to do sql call";
   			}


//			while (($source_file = readdir($source)) !== false) {
//				if (($source_file != ".") && ($source_file != "..")) {
//				}
 //       		}
		print "</uL>";
			
		//	print "<div id='des'></div>";
        		closedir($source);
		 }
	    }
	
		print "</div><div id='hello'></div>";

    			print "<div id='des'></div>";
    			//print "<div id='des' style='width:70%;float:right;background-color:blue;'>";

}

    	closedir($dh);
    	print "</div>"; //leftpart
  	}


//   if ($conn->query($sql) == TRUE) {
	//TAke them to uploadfile.php
        //    echo "New record created successfully";
//   } else {
//       echo "Error: " . $sql . "<br>" . $conn->error;
//   }
}

if (isset($_POST['submit1'])) {
//if ((isset($_POST['submit1'])) && (isset($_GET['sid']))) {
//if (isset($_GET['sid'])) {
   	$did = $_GET['did'];
	$user_id = $_SESSION['login'];
	$tid = $_POST['tid'];
	$sid = $_POST['sid'];
	//print "<br><br>MY SID IS ".$sid;
	//print "<br><br>MY TID IS ".$tid;
	//check if user has already voted for this dataset
	$sql = "SELECT * from votes where datasetid='$did' and userid='$user_id' and Sourceid='$sid' and Targetid='$tid'";
   	$result = $conn->query($sql);
   	if ($result->num_rows > 0){ //already voted
		print "You have already voted for this dataset";
        	while($row = $result->fetch_assoc()) {
				print_r ($row);
		}
   	} else {	//not yet voted, go ahead
		//echo "failed to do sql call";
		if (isset($_POST['vote1'])) {
			$v = $_POST['vote1'];
	//		print $v;
			$addV = "INSERT INTO votes (datasetid, vote, userid, Targetid, Sourceid) VALUES ('$did', '$v', '$user_id', '$tid', '$sid')";
	//		print "<br><br>".$addV;
			if ($conn->query($addV) === TRUE) {
				//    echo "<p>Insert went well</p>";
			} else {
    				echo "unable to insert";
			}		
		}	
	}
		if (isset($_POST['theComment'])) {
			$comm = $_POST['theComment'];
	//		print $comm;
			$addComm = "INSERT INTO Dcomment (Did, Comments, Userid, historylog, Targetid, Sourceid) VALUES ('$did', '$comm', '$user_id', now() , '$tid', '$sid')";
	//		print "<br><br>".$addComm;
			if ($conn->query($addComm) === TRUE) {
				//    echo "<p>Insert went well</p>";
			} else {
    				echo "unable to insert";
			}			
		}
				

   	

	
	
}


$conn->close();



/*
		if (is_dir($target_dir)) { //print target in low dir 
		//print "low exists";
		if ($target = opendir($target_dir)) {
			while (($target_file = readdir($target)) !== false) {
				if (($target_file != ".") && ($target_file != "..")) {
				}
        		}
        		closedir($target);
		}
	}
*/


//	if (($file != ".") && ($file != "..")) {
      		//print "file: <a href='readthefile.php?fname=".$file."'>".$file." </a>  <br>";
  //    		print "file: <a href='displayfile.php?fname=".$file."'>".$file." </a>  <br>";
//	}	
  //  }
/*

HERERERERERE

*/
?>


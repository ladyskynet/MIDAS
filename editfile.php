
<?php
include "admin.php";
session_start();

$user_id = $_SESSION['login'];
print "user id is ".$user_id;

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
   print $source_dir;
   $target_dir = $dir."/".$owner_dir."/".$fdir2."/low";
?>

<form action="editfileNow.php" method="post" enctype="multipart/form-data">

<!--
<p>Dataset Name: <input type="text" name="dset_name"></p>
-->
<p>	  Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</p>
 </form>

<?php
/*
if (isset($_GET['ename'])) {
		$s_id = $_GET['ename'];
		$did = $_GET['theid'];
		//$did = '101';
		$the_target = "select target from source_target2 where source = '".$s_id."' and did='".$did."'";
		$res = $conn->query($the_target);
		if ($res->num_rows > 0) {
			//print "<div id='hello'><h3>Target Items</h3><ul>";
			print "<h3>Target Items</h3><ul>";
			while($row = $res->fetch_assoc()) {
		//		print_r ($row['target']);
				$m = explode(';', $row['target']);
		//		print_r ($m);
				foreach ($m as $key) {
					$n = strstr($key, '.txt', TRUE);
					//print $n;			
            				//echo '<li value='.$n.'>'.$n.'</li>';
            				echo '<li value='.$n.' onClick="showDes(\''.$key.'\', '.$did.', \''.$s_id.'\')">'.$n.'</li>';
            				//echo '<p value='.$row['source'].' onClick="showTarget(\''.$row['source'].'\', '.$did.')">'.$s.'</p>';
            				//echo '<li value='$n' onClick="showDes(\''.$n.'\', '.$did.')">'.$n.'</li>';
            				//print "<li><a href='displayfile.php?tname=".$n."'>".$n."</a></li>";
				}
			}

			print "</ul></div></div>";
		}
	  }
   
elseif (isset($_GET['describ'])) {
		$t_id = $_GET['describ'];
		$did2 = $_GET['theid'];
		$sid = $_GET['sid'];
		$x = "select * from datasets where id= '$did2'";
		$res = $conn->query($x);
		if ($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				print_r ($row);
				$theS = MYFILES.$row['filedirectory']."/".$row['fdir2']."/high/".$sid;
				$theT = MYFILES.$row['filedirectory']."/".$row['fdir2']."/low/".$t_id;
		//		print "<br>".$theS;
		//		print "<br>".$theT;

				
				$slines = array();
				$sfile = fopen($theS, "r");
				while(!feof($sfile)) {
    					//read file line by line into a new array element
    					$slines[] = fgets($sfile, 4096);
				}
				fclose ($sfile);
				print "<h4>Source Description</h4>";
				print $slines[0];

				$tlines = array();
				$tfile = fopen($theT, "r");
				while(!feof($tfile)) {
    					//read file line by line into a new array element
    					$tlines[] = fgets($tfile, 4096);
				}
				fclose ($tfile);
				print "<h4>Target Description</h4>";
				print $tlines[0];

	
				print "<h3>Vote:</h3>";
				print " <form name='myvote' action='vote.php' method='POST'>
				<input type='radio' name='vote1' value='black' checked >Link (black)<br>
				<input type='radio' name='vote1' value='white'>Not a link (white)<br>
				<input type='radio' name='vote1' value='gray'>Possible link (gray)<br>
				</form>";

				print "<h3>Comments</h3>";
				print "<textarea style='width:600px; height:200px;' name='theComment'>    </textarea>";

			}

			print "</div>";
		}
	  }
   
else {

include "logout.php";


   print "<div id='main' style='width:98%;background-color:red;padding:15px;height: 800px;'>";

// Open a directory, and read its contents
   if (is_dir($dir)){
       if ($dh = opendir($dir)){
          print "<div id='leftpart' style='width:30%;float:left;background-color:pink;'><u>";
       //    while (($file = readdir($dh)) !== false){

           if (is_dir($source_dir)) { //print sources in high dir
		//print "high exists";
		if ($source = opendir($source_dir)) {
			//print "<h3>Source Items</h3><ul name="mysource" onClick="showTarget(this.value)">";
			print "<h3>Source Items</h3>";
			//print "<h3>Source Items</h3><ul name='mysource' onClick='showTarget(\''.$row['source'].'\')'>";
			//print "<h3>Source Items</h3><ul name='mysource' onClick='showTarget(this.value)'>";
   
			$sql = "SELECT * from source_target2 where did='$did'";
			//print $sql;

			//$slist = array()o
   			$result = $conn->query($sql);
   			if ($result->num_rows > 0){
        			while($row = $result->fetch_assoc()) {
	    	//			print "<pre>"; print_r ($row); print "</pre>";
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
		print "</uL><div id='hello'></div></div>";
    			print "<div id='des' style='width:70%;float:right;background-color:blue;'><h3>ERIKAAAAAAAAAAAAAAAAAAAAAAAAAaa</h3><ul>";
		//	print "<div id='des'></div>";
        		closedir($source);
		 }
	    }

}

    	closedir($dh);
    	print "</div>"; //leftpart
  	}


   if ($conn->query($sql) == TRUE) {
	//TAke them to uploadfile.php
        //    echo "New record created successfully";
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
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


*/
?>


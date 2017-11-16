<?php

include "logout.php";
include "admin.php";

session_start();

$user_id = $_SESSION['login'];
$dset_name = $_SESSION['dname'];
$fdir2 = $_GET['fdir2'];
$fdir = $_GET['fdir'];

print "<pre>"; print_r ($_SESSION); print "</pre>";

$sql1 = "SELECT * from datasets where userid='$user_id' and name='$dset_name'";
print "<br> $sql1";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
        print_r ($row);
        $did = $row["id"];
        $_SESSION['did'] = $did;
    }
}
else {
        echo "failed to do sql1 call";
}

$myfile = MYFILES;
$filedir = MYFILES.$fdir;
$thedir = $filedir."/".$fdir2;

//RENAME OLD DIR BEFORE NEW UPLOAD?
if (file_exists($thedir)) {
	system("cd $fdir; mv $fdir2 $fdir2.old ");
}

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $dir2)) {
        
	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

	$x = strtok($thefile, '.');
	print $x;

	//unzip the file
	system('unzip ' .$dir2. ' -d '.$dir. ' > /dev/null 2>&1');

	$newdir = $dir.$x."/";
	print "<br>NEW DIR IS $newdir";
	//system("cd $newdir");
	
	$target_file2 = $newdir."results.txt";
	print "TFILE2 is ".$target_file2;

      if (file_exists($target_file2)) {
	//read results.txt file content
	$lines = array();
	$a = array();
        //$sfile = fopen($target_file, "r");
        $sfile = fopen($target_file2, "r");

       
	while(!feof($sfile)) {
        	//read file line by line into a new array element
                $lines = fgets($sfile, 4096);
		list($each_one) = explode("%", $lines);
		//print "<pre>"; print_r ($a); print "</pre>"; 
	
		if ($each_one[0] !== "") {
			$each_val = preg_split("/[\s,]+/", trim($each_one));
			print "<pre> EACH VAL IS ";
			print_r ($each_val);
			print "</pre>";

			$m = count($each_val);
			if ($m>2) {
				$join = implode(';', array_slice($each_val,1));
				print "<pre> JOIN IS ";
				print_r ($join);
				print "</pre>";
				
				//insert $join into table and $each_val[0] into another table FIX HERERERERERERRE
				//print " e = ".$dset_id;
				$sql3 = "INSERT INTO source_target2 (source, target, did) VALUES ('$each_val[0]', '$join', '$dset_id')";
				//print  "INSERT INTO source_target2 (source, target, did) VALUES ('$each_val[0]', '$join', '$dset_id')";
				if ($conn->query($sql3) === TRUE) {
					//    echo "<p>Insert went well</p>";
					//    echo "<p>Insert went well</p>";
				} else {
    					echo "unable to insert";
				}		


			}
				//CALL INSERT SQL HERE
				//insert into dset_source values("", $each_val[0], $descrip
		}
	}
	
    fclose ($sfile);
    }
	}
}


?>


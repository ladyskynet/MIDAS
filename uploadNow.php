<?php

//echo "<p>inside uploadNow.php</p>";

include "logout.php";
include "admin.php";



session_start();



$user_id = $_SESSION['login'];
$dset_name = $_SESSION['dname'];

echo "<p>user_id is</p>", $user_id;
echo "<p>dest_name is</p>", $dset_name;


//GET USERID FROM SESSION

$sql1 = "SELECT id from datasets where userid='$user_id' and name='$dset_name'";
print "<br>  $sql1 ";
$result = $conn->query($sql1);

//echo "result is ";
//print_r($result);

if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
        print_r ($row);
        $did = $row["id"];
        $_SESSION['did'] = $did;
        //Hayes moved this from line 48
        $dset_id = $_SESSION['did'];
        //Hayes added next two lines
        $exists = true;
        //echo " dataset name and username already exists in datasets table, will do update versus insert ";
    }
}
else {
        echo " failed to do sql1 call ";
        //Hayes added next two lines
        $exists = false;
        //echo "dataset name and username do not already exist in datasets table, will do insert versus update";
}

//Hayes commented this out
//$dset_id = $_SESSION['did'];

if ($conn->query($sql1) == TRUE) {
//    echo "New record created successfully";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

//GET THE DSET ID FROM TABLE TO BE INSERTED TO THE OTHER TABLES, PUT IT IN SESSION


$user =$_SESSION['login']; 
//Hayes changed to (16, 500) until have ability to delete folders
$rand_num = rand(16, 500);
$random_dir = $user.$rand_num;
print "<br> file dir is  ".$random_dir;

//CREATE MKDIR Random_dir give write access

$target_dir = MYFILES;
$dir = $target_dir.$random_dir."/";
 
echo "Dir is $dir";

if (!file_exists($dir))
{
	mkdir($dir, 0777);
	echo "Just created $dir";
}
else
{
	echo "Using existing $dir";
}

$thefile = $_FILES["fileToUpload"]["name"];  // this is temp dir name
					
$n = strstr($thefile, '.zip', TRUE);
//IF UPLOAD SUCCESS INSERT INTO DATASET VALUE $dset_name, $user_id, $random_dir

// Hayes changed from UPDATE to insert or update on 11/8/2017
if ($exists === FALSE)
	{$sql = "INSERT into datasets (filedirectory, fdir2, name, userid) values ('$random_dir','$n','$dset_name','$user')";
	print "<br>  $sql ";
    echo " New record created successfully ";
} 
//else {
 //   echo "Error: " . $sql . "<br>" . $conn->error;
//}
	
    //echo "just set query to be an insert into datasets ";
 //   }
	else 
	{//old line is below
    $sql = "UPDATE datasets set filedirectory='$random_dir', fdir2='$n' where name='$dset_name' and userid='$user'";
    //echo " just set query to be an update in datasets versus insert ";
    }

if ($conn->query($sql) === TRUE) {
    echo " New record created successfully ";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

	//Hayes - Do a second query if had to insert the dataset (exists = false) to get the id of the dataset that we just inserted, store this to dset_id
	if ($exists === FALSE)
		{$sq2 = "SELECT id from datasets where userid='$user_id' and name='$dset_name'";
	    $result= $conn->query($sq2);
	    while($row = $result->fetch_assoc()) {
           print_r ($row);
           $did = $row["id"];
           $_SESSION['did'] = $did;
           //Hayes moved this from line 48
           $dset_id = $_SESSION['did'];}
           echo " just got dest_id for the new dataset we added to table ";}


//AFTER INSERT INTO DATASET TABLE, START UNZIPPING THE FILE


//AFTER UNZIP FILE, INSERT DATA INTO SOURCE, TARGET FILE



//$thefile =$_FILES["fileToUpload"]["name"];
print " file is  $thefile ";

$filename = "results.txt"; 

//$target_dir = '/mounts/u-zon-d2/ugrad/akali2/HTML/project/myfiles/'.$random_dir.'/'.$thefile.'/';
//$target_dir = MYFILES;
//print "<br>target dir is ".$target_dir;

//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


//$target_file = $dir.'/'.$thefile."/".$filename;
$target_file = $dir.$filename;
print "<br><br>  target file is ".$target_file."<br>";

//$target_file = $target_dir .$filename;
$uploaded = 1;


// Check if file already exists
if (file_exists($target_file)) {
    echo "File already exists.";
    $uploaded = 0;
}


//move uploaded file to the random_dir


//print $_FILES["fileToUpload"]["tmp_name"];

$dir2 = $dir.basename($_FILES["fileToUpload"]["name"]); 
print "DIR2 is  $dir2";


// Check if file is uploadeed 
if ($uploaded == 0) {
    echo "File was not uploaded.";
} 



else {

    //if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $dir2)) {
        
	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

	$x = strtok($thefile, '.');
	print $x;

//new code from Nasir
	$zip = new ZipArchive;
	if ($zip->open($dir2) === TRUE)
	{
    		$zip->extractTo($dir);
    		$zip->close();
    		echo "Extracted $dir2 Successully to $dir";
	} 
	else
	{
    		echo 'Failed to extract $dir';
	}

	//Hayes changed 777 to 0777
//	system('chmod 0777 '.$dir);
	//system('unzip ' .$dir2. ' -d '.$dir. ' > /tmp 2>&1');
	//Hayes 
//	system('unzip ' .$dir2. ' -d '.$dir. ' > '.$dir.'  2>&1');
	//print "  Im here - just unzipped";

	$newdir = $dir.$x."/";
	print "<br>NEW DIR IS $newdir";
	//system("cd $newdir");
	
	$target_file2 = $newdir."results.txt";
    print "TFILE2 is ".$target_file2;

      if (file_exists($target_file2)) {
	//read results.txt file content
      	print "Im here at line 166";
	$lines = array();
	$a = array();
        //$sfile = fopen($target_file, "r");
        $sfile = fopen($target_file2, "r");

       
	while(!feof($sfile)) {
        	//read file line by line into a new array element
		print "Im here at line 175";
                $lines = fgets($sfile, 4096);
		list($each_one) = explode("%", $lines);
		//print "<pre>"; print_r ($a); print "</pre>"; 
		
		if ($each_one !== '') {
			$each_val = preg_split("/[\s,]+/", trim($each_one));
			print "<pre> EACH VAL IS "; print_r ($each_val); print "</pre>";

			$m = count($each_val);
			//print "<br>MMMM is ".$m;
			if ($m>2) {
				$join = implode(';', array_slice($each_val,1));
			//	print "<pre> JOIN1 IS ";
			//	print_r ($join);
			} 
			elseif ($m==1 ) {
				$join = '';
				//print "<pre> JOIN2222 IS "; print_r ($join); print "</pre>";
			}
			elseif ($m==2) {
				$join = $each_val[1];
				print "<pre> JOIN333 IS "; print_r ($join); print "</pre>";
				
			}
	
				//insert $join into table and $each_val[0] into another table FIX HERERERERERERRE
				//print " e = ".$dset_id;
				$sql3 = "INSERT INTO source_target2 (source, target, did) VALUES ('$each_val[0]', '$join', '$dset_id')";
				//print  "INSERT INTO source_target2 (source, target, did) VALUES ('$each_val[0]', '$join', '$dset_id')";
				if ($conn->query($sql3) == TRUE) {
					//    echo "<p>Insert went well</p>";
				} else {
    					echo "unable to insert";
				}		
				header ("location:index.php");

			}
		}
    fclose ($sfile);
	}
	
    //}

	}
}

 


/*
   } else {
        echo "Error uploading file";
    }
}
*/
$conn->close();


?> 

<?php
// Albert Kalim
// uploadswork.php
// Precondition: Project name entered; zip file to be uploaded exists and selected
// Postcondition: Zip file uploaded successfully.  The system will not upload other types of file.
if ((($_FILES["zip_file"]["type"] == "application/zip")
|| ($_FILES["zip_file"]["type"] == "application/x-zip-compressed")
|| ($_FILES["zip_file"]["type"] == "multipart/x-zip")
|| ($_FILES["zip_file"]["type"] == "application/x-compressed")
|| ($_FILES["zip_file"]["type"] == "application/octet-stream"))
&& ($_FILES["zip_file"]["size"] < 20971520)) {
//20971520 is the integer value for 20Mb
//($_FILES["zip_file"]["name"]) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
	$name = explode(".", $filename);
//$target = PHYSICAL_PATH."uploads/";
$accepted_types = array("application/zip", "application/x-zip-compressed", "multipart/x-zip", "application/x-compressed", "application/octet-stream");
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		}
	}

	$okay = strtolower($name[1]) == 'zip' ? true : false;
	if(!$okay) {
		$message = "The file you are trying to upload is not a .zip file. Please try again.";
	}

	$target_path = "/mounts/u-zon-d2/ugrad/akali2/HTML/project/uploadswork/".$filename;  
//$saved_file_location = $target.$filename;

if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			$zip->extractTo("/mounts/u-zon-d2/ugrad/akali2/HTML/project/uploadswork/");
			$zip->close();
			unlink($target_path);
		}
		$message = "Zip file uploaded. Click here to see the data set.";
	} else {
		$message = "There was a problem with the upload. Please try again.";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload a zip file</title>
</head>

<body>

<h3>Upload a zip file</h3>

<?php if($message) echo "<p>$message</p>"; ?>
<form enctype="multipart/form-data" method="post" action="">

 <label>Project name: <input type="text" name="project" required/></label><br><br>
 



<label>Choose a zip file to upload (max. 20MB): <input type="file" name="zip_file" /></label>
<br /><br>
<input type="submit" name="submit" value="Upload" /><br><br><label>Note: To update a previously imported zip file, name the project the same as before. You can find the project name in the data set display.</label>
</form>
</body>
</html>

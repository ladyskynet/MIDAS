<?php
if(isset($_FILES['zip'])){
    $errors = array();

    $zip = new ZipArchive();

    if(strtolower(end(explode('.', $_FILES['zip']['name'])))!=='zip'){
        $errors[] = 'That does not look like a .zip file.';
    }

    if($_FILES['zip']['size']>104857600){
        $errors[] = 'There is a size limit of 100MB';
    }

    if($zip->open($_FILES['zip']['tmp_name'])==false){
        $errors[]='Failed to open zip file.';
    }

    if(empty($errors)){
        $extracted_files = array();

        for($i=0;$i<$zip->numFiles;$i++){
            $entry_info = $zip->statIndex($i);

            $extracted_files[] = $entry_info['name'];
        }

        print_r($extracted_files);

        $zip->extractTo('uploadswork');
        $zip->close();
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




<label>Choose a zip file to upload (max. 10MB): <input type="file" name="zip" /></label>
<br /><br>
<input type="submit" name="submit" value="Upload" /><br><br><label>Note: To update a previously imported zip file, name the project the same as before. You can find the project name in the data set display.$
</form>
</body>
</html>


<?php
$filename = $_GET['fname'];
print $filename."<br>";
$fdir = '/mounts/u-zon-d2/ugrad/akali2/HTML/project/myfiles/'.$filename;
//print $fdir;

$lines = array(); 
$file = fopen($fdir, "r"); 
while(!feof($file)) { 

    //read file line by line into a new array element 
    $lines[] = fgets($file, 4096); 
   
} 
fclose ($file); 
print_r($lines); 
?> 


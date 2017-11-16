<?php
session_start();

session_destroy();
session_unset();

header ("location: login.php");
/*
print "<pre>";
print_r($_SESSION);
print "</pre>";
*/
//GET USERID FROM SESSION
//$user_id = $_SESSION['login'];
 
//print MYFILES;

//GET USER FROM SESSION!
//$user = $_SESSION['login'];
/* Block this for now 

$user = 'ekali';
print "user is ".$user;

if (isset($_POST['addName'])) {

$dset_name = $_POST['dset_name'];
$_SESSION['dname'] = $dset_name;


print "MY SESSION IS: <pre>";
print_r ($_SESSION);
print "</pre>";
*/

//ALBERT 
//DO INSERT DQL HERE!!!!!
/*
$sql = "INSERT INTO datasets (name, userid, filedirectory) VALUES ('$dset_name', '$user_id', '')";
if ($conn->query($sql) === TRUE) {
//    echo "<p>Insert went well</p>";
} else {
    echo "unable to insert";
}


	header("location:uploadfile.php");
*/

/*
//ALBERT
//DO SELECT HERE
$sql = "SELECT id from datasets where userid='$user_id' and name='$dset_name'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
	print_r ($row);
        $did = $row["id"];
	$_SESSION['did'] = $did;
    }
}
else {
	echo "failed to do sql call";
}




if ($conn->query($sql) === TRUE) {
	//TAke them to uploadfile.php
//    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/

/*
print "MY SESSION IS: <pre>";
print_r ($_SESSION);
print "</pre>";
*/
//$conn->close();







?>

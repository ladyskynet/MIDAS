<?php

include "logout.php";
include "admin.php";
echo '<link href="table.css" rel="stylesheet">';
//include "table.css";


session_start();


//GET USERID FROM SESSION
$user_id = $_SESSION['login'];
?> 

<html>
<table>
<tr>
    <td>Hello HTML!</td>
    <td>Hello CSS!</td>
    <td>Hello JS!</td>
</tr>
</html>



<?php

echo "in testfile";

?>
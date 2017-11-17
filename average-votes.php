<?php

include "logout.php";
include "admin.php";

session_start();


//GET USERID FROM SESSION
$user_id = $_SESSION['login'];
?> 

<!DOCTYPE HTML>
<html>
  <head>
    <title>Average</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
  </head>
  <body>
    <!-- Wrapper -->
    <div id="wrapper">
      <!-- Header -->
      <header id="header">
        <div class="inner">
          <!-- Logo -->
          <a href="index.html" class="logo">
            <span class="symbol"><img src="images/goldstack.png" alt="" /></span><span class="title">Midas</span>
          </a>
          <!-- Nav -->
          <nav>
            <ul>
              <li><a href="#menu">Menu</a></li>
            </ul>
          </nav>
        </div>
      </header>

      <!-- Menu -->
      <nav id="menu">
        <h2>Menu</h2>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="addData.php">Upload New Set</a></li>
          <li><a href="dlist.php">View All Sets</a></li>
          <li><a href="average-votes.php">View All Averages</a></li>
          <li><a href="delete.php">Manage All Sets</a></li>
        </ul>
      </nav>

      <!-- Main -->
      <div id="main">
        <div class="inner">
          <div class="row">
            <div class="6u 12u$(medium)">
              <ul class="actions">
                <li><a href="#" class="button special">Logout</a></li>
                <li><a href="#" class="button">Home Page</a></li>
              </ul>
            </div>
          </div>
          <h1>Averages</h1>
          <!-- Table -->
          <section>
            <h3>of the votes for all links in data set:</h3>
            <div class="table-wrapper">
              <table>
                <thead>
                  <tr>
                    <th> TargetID </td>
                    <th> SourceID </td>
                    <th> Vote </td>
                    <th> Count </td>
                    <th> Percentage </td>
                  </tr>
                </thead>
                <tbody>
                  
                    <?php
                      $sql = "SELECT v1.TargetID as target, v1.SourceID as source, v1.vote, v1.vote_count, (v1.vote_count/v2.all_count)*100 as percentage 
FROM 
(SELECT TargetID, SourceID, vote, COUNT(vote) as vote_count FROM votes GROUP BY TargetID, SourceID, vote) as v1
INNER JOIN
(SELECT TargetID, SourceID, COUNT(*) as all_count FROM votes GROUP BY TargetID, SourceID) as v2
ON 
v1.TargetID LIKE v2.TargetID
AND v1.SourceID LIKE v2.SourceID";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>
                    <td>" . $row['target'] . "</td>
                    <td>" . $row['source'] . "</td>
                    <td>" . $row['vote'] . "</td>
                    <td>" . $row['vote_count'] . "</td>
                    <td>" . $row['percentage'] . "</td>
                    <ul> </ul>
                  </tr>";
                        }
                      }
                    ?>
                   
                </tbody>
              </table>
            </div>
          </section>  
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
  </body>
</html>

<?php
$conn->close();
?>


<?php
function dbconnect(){
  $mysqlhost ="localhost";
  $mysqluser ="root";
  $mysqlpass =""; //vertrigo
  $mysqldb ="meteoro";

  $db = new mysqli($mysqlhost, $mysqluser, $mysqlpass, $mysqldb);
  mysqli_select_db($mysqldb,$db);

  // $mysqlhost ="localhost";
  // $mysqluser ="edmeteoro@meteor";
  // $mysqlpass ="5#HeKac5bre#"; //vertrigo
  // $mysqldb ="meteoro";

  $db = mysql_connect($mysqlhost, $mysqluser, $mysqlpass);
  mysql_select_db($mysqldb,$db);

  if (!$db) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }
  return $db;
  }
  ?>

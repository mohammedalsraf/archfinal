<?php

include("conn.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $dep= $_POST["inputName"];
  $sql="INSERT INTO `dep_table`(`dep`) VALUES ('$dep')";
  if(!empty($dep)){
    $res = $conn->query($sql);
    if (!$res) {
      die("SQL Fail" . mysqli_connect_error());
    }

    header("location: add.php");


  }
  header("location: add.php");



  }

  
 





  

  

?>

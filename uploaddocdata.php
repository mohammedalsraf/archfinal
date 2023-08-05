<?php
include("conn.php");
/////////////////////////////////////////// start of upload main for data 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submet'])) {
  
      $doctype = $_POST['doctype'];
      $docnumber = $_POST['docnumber'];
      $date = $_POST['date'];
      $dep = $_POST['dep'];
      $sery=$_POST['sery'];
      $copyto = $_POST['copyto'];
      $topic = $_POST['topic'];
      $updateup = $_POST['updateup'];
      $username = $_POST['username'];
      $notes = $_POST['notes'];
      ////////////////////// upload file 
      $file = $_FILES["file"];
      // print_r($file);
      $fileName = $_FILES['file']['name'];
      // $fileNameForMysql = basename($_FILES["file"]["name"]);
      $fileTemp = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];
      $fileExt = explode('.', $fileName);
      $fileRealExt = strtolower((end($fileExt)));
      $allowedFile = ["jpg", "png", "jpeg", "pdf"];
      if (in_array($fileRealExt, $allowedFile)) {
        if ($fileError === 0) {
          if ($fileSize < 5000000) {
            $fileNewName = uniqid('', true) . "." . "$fileRealExt";
            $fileDestenation = 'uploads/' . $fileNewName;
            move_uploaded_file($fileTemp, $fileDestenation);
  
          } else {
            die("Sorry there is Error check file size less than 5 MB and try again!");
  
          }
  
        } else {
          die("Sorry there is Error plase tray again!");
  
        }
  
      } else {
        die("upload Fail this file type not supported" . mysqli_connect_error());
      }
  
      ////////////////// end of file upload
  
      $sql = "INSERT INTO `users`(`doctype`, `docnumber`, `date`, `dep`,`sery`, `copyto`, `topic`, `filename`, `updateup`, `username`, `notes`) VALUES ('$doctype','$docnumber','$date','$dep','$sery','$copyto','$topic','$fileNewName','$updateup','$username','$notes')";
      $res = $conn->query($sql);
      if (!$res) {
        die("SQL Fail" . mysqli_connect_error());
      }
  
      header("location: home.php");
  
  
    }
  
  }
  
  ///////////////////////////////////// end of upload main form data 




?>
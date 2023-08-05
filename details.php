<?php 
include("conn.php");

if($_SERVER['REQUEST_METHOD']==='GET'){
    if(isset($_GET["id"])) {
        $id=$_GET['id'];
      
        $sql="SELECT * FROM `users` WHERE id=$id";
        $res=$conn->query($sql);
        if(!$res){
            die("SQl Fail".mysqli_error($conn));
        }
        $row=$res->fetch_assoc();


    }
}


?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details</title>
  <!-- Bootstrap CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>
<?php include("menuandnav.php") ?>
<body>
  <div class="container mt-4 maintable">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        
        <h5 class="boldfont-weight-bold"></h5>
        
        
        <ul class="list-group mb-4">
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo"  نوع الكتاب :".$row['doctype'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo"  رقم الكتاب :".$row['docnumber'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" تاريخ الكتاب :".$row['date'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" القسم الصادر منه الكتاب :".$row['dep'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" درجة السرية   :".$row['sery'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" نسخة منه الى  :".$row['copyto'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" موضوع الكتاب :".$row['topic'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo"صورة الكتاب :"."<a href='uploads/$row[filename] '    target='_blank'  /> $row[filename] </a>"  ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" اخر تحديث :".$row['updateup'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" اسم المستخدم  :".$row['username'] ?></h3></li>
          <li class="list-group-item font-weight-bold"><h3 class=" font-weight-bold"><?php echo" الملاحضات :".$row['notes'] ?></h3></li>
          
          
          <!-- Add more item details here -->
        </ul>
        <div class="me-5">
        <?php echo "<a href='update.php?id=$row[id]' class='btn btn-primary mr-2'>تحديث</a>"?>
        <?php echo "<a href='delet.php?id=$row[id]' class='btn btn-danger mr-2'onclick='confirmationDelete();return false;'>حذف</a>"?>
       
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS (Optional, if you need to use Bootstrap's JS features) -->
  <script src="code.jquery.com_jquery-3.7.0.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script> -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script >
    function confirmationDelete(anchor)
{
   var conf = confirm('هل انت متاكد انك تريد حذف هذا العنصر ؟');
   if(conf)
      window.location=anchor.attr("href");
}

</script>
</body>
</html>


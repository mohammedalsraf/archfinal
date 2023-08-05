<?php

include("conn.php");
include("getdep.php");
if($_SERVER['REQUEST_METHOD']==='GET'){
     if(isset($_GET["id"])) {
        $id=$_GET["id"];
        $sql="SELECT * FROM `users` WHERE id=$id";
        $res=$conn->query($sql);
        if(!$res){
            die("SQl Fail".mysqli_error($conn));
        }
        $row=$res->fetch_assoc();
        $doctype = $row['doctype'];
      $docnumber = $row['docnumber'];
      $date = $row['date'];
      $dep = $row['dep'];
      $sery=$row['sery'];
      $copyto =$row['copyto'];
      $topic =$row['topic'];
      $updateup = $row['updateup'];
      $username =$row['username'];
      $notes = $row['notes'];
      // $filename=$row['filename']; no neeeed

         }

}else{
  $id=$_POST['id'];
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
  if ($_FILES['file']['size'] > 0){

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
  }
  
  if(!empty($fileNewName)){
    $sql = "UPDATE `users` SET `doctype`='$doctype',`docnumber`='$docnumber',`date`='$date',`dep`='$dep',`sery`='$sery',`copyto`='$copyto',`topic`='$topic',`filename`='$fileNewName',`updateup`='$updateup',`username`=' $username',`notes`='$notes' WHERE id=$id";
    $res = $conn->query($sql);
    if (!$res) {
      die("SQL Fail" . mysqli_connect_error());
    }
  
    header("location: home.php");
  
    

  }else{
    $sql = "UPDATE `users` SET `doctype`='$doctype',`docnumber`='$docnumber',`date`='$date',`dep`='$dep',`sery`='$sery',`copyto`='$copyto',`topic`='$topic',`updateup`='$updateup',`username`=' $username',`notes`='$notes' WHERE id=$id";
    $res = $conn->query($sql);
    if (!$res) {
      die("SQL Fail" . mysqli_connect_error());
    }
  
    header("location: home.php");

  }
 

}
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
   
</head>

<body>
<?php include("menuandnav.php") ?>
  <form  method="post" enctype="multipart/form-data">
    <div class="container my-5 col-6">

      <!-- row1 -->
      <div class="row">
        <div class="col-3">
        <input type="hidden" id="custId" name="id" value="<?php echo $id ?>">
          <label for="formGroupExampleInput2" class="form-label"> نوع الكتاب</label>
          <select name="doctype" class="form-select" aria-label=".form-select-sm example">
          <option value="صادر" <?php if ($doctype === 'صادر') echo 'selected'; ?>>صادر</option>
          <option value="وارد" <?php if ($doctype === 'وارد') echo 'selected'; ?>>وارد</option>
          <option value="اخرى" <?php if ($doctype === 'اخرى') echo 'selected'; ?>>اخرى</option>
            
          </select>
        </div>

        <div class="mb-3 col-3">
          <label for="formGroupExampleInput2" class="form-label">رقم الكتاب</label>
          <input type="text" class="form-control" id="formGroupExampleInput2" name="docnumber" required value=<?php echo  $docnumber?> >
        </div>
        <div class="mb-3 col-3">
          <label for="formGroupExampleInput2" class="form-label">تاريخ الكتاب</label>
          <input type="date" class="form-control" id="formGroupExampleInput2" name="date"
            value="<?php echo $date ?>" required>
        </div>
      </div>
      <!-- row1 -->
      <div>
        
          <div class="col-5">
            <label for="formGroupExampleInput2" class="form-label"> القسم الصادر منه</label>
            <select id="dep" name="dep" class="form-select" aria-label=".form-select-sm example">

              <?php foreach ($deps as $deps): ?>
                <option value="<?php echo $deps['dep'];?>" <?php if($dep==$deps['dep']) echo 'selected';?>><?php echo $deps['dep']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        
        <div class="col-3">
          <label for="formGroupExampleInput2" class="form-label">درجة السرية</label>
          <select name="sery" class="form-select" aria-label=".form-select-sm example">
          <option value="سري" <?php if ($sery === 'سري') echo 'selected'; ?>>سري</option>
          <option value="بدون" <?php if ($sery === 'بدون') echo 'selected'; ?>>بدون</option>
          
         
          </select>
        </div>




        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">نسخة منه الى</label>
          <textarea rows="4" cols="50" class="form-control" id="formGroupExampleInput2" name="copyto" 
            required> <?php echo $copyto ?> </textarea>
        </div>
        <!-- row2 -->
        <div class="row">
          <div class="mb-3 col-6">
            <label for="formGroupExampleInput2" class="form-label">الموضوع</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="topic" required  value="<?php echo $topic ?>">
          </div>

          <div class="mb-3 col-6">
            <label for="formGroupExampleInput2" class="form-label">رفع الكتاب</label>
            <input type="file" class="form-control" id="formGroupExampleInput2" name="file" >
          </div>
        </div>
        <!-- row2 -->
        <div class="row">
          <div class="mb-3 col-3">
            <label for="formGroupExampleInput2" class="form-label ">تاريخ اخر تحديث</label>
            <input type="date" class="form-control" id="formGroupExampleInput2" name="updateup"
              value="<?php echo $updateup ?>" required>
          </div>
          <div class="mb-3 col-3">
            <label for="formGroupExampleInput2" class="form-label">اسم المستخدم</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="username" required value="<?php echo $username ?>" readonly>
          </div>
          <div class="mb-3 col-6">
            <label for="formGroupExampleInput2" class="form-label">الملاحضات</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="notes"    value="<?php echo $notes ?>">
          </div>
        </div>
        <div class="mb-3">
          <button type="submet" class="btn btn-primary" name="submet">حفظ</button>

        </div>
      </div>


  </form>

  <!-- Modal -->
  <div class="modal fade" id="popupFormModal" tabindex="-1" role="dialog" aria-labelledby="popupFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Modal header -->
        <div class="modal-header">
          <h5 class="modal-title" id="popupFormModalLabel">اضافة قسم</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- Add your form elements here -->
          <form id="popupFormContent" method="post" action="submitpopup.php">
            <div class="form-group">
              <div class="mb-2"><label for="inputName">ادخل اسم القسم</label></div>
              <div class="mb-2"><input type="text" class="form-control" name="inputName" id="inputName"></div>
              <div class="mb-2"> <input type="submit" value="حفظ" class="form-control bg-primary text-light"></div>
            </div>
            <!-- Add other form fields as needed -->
          </form>
</body>

</html>
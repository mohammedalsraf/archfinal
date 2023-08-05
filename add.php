<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}
include("conn.php");
include("getdep.php");
include("uploadDocData.php");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">

</head>

<body>
  
<?php include("menuandnav.php") ?>


  <form action="uploadDocData.php" method="post" enctype="multipart/form-data">
    <div class="container my-5 col-6">
    

      <!-- row1 -->
      <div class="row">
        <div class="col-3">
          <label for="formGroupExampleInput2" class="form-label"> نوع الكتاب</label>
          <select name="doctype" class="form-select" aria-label=".form-select-sm example">
            <option value="صادر">صادر</option>
            <option value="وارد">وارد</option>
            <option value="اخرى">اخرى</option>
          </select>
        </div>

        <div class="mb-3 col-3">
          <label for="formGroupExampleInput2" class="form-label">رقم الكتاب</label>
          <input type="text" class="form-control" id="formGroupExampleInput2" name="docnumber" required>
        </div>
        <div class="mb-3 col-3">
          <label for="formGroupExampleInput2" class="form-label">تاريخ الكتاب</label>
          <input type="date" class="form-control" id="formGroupExampleInput2" name="date"
            value="<?php echo date('Y-m-d'); ?>" required >
        </div>
      </div>
      <!-- row1 -->
      <div>
        
          <div class="col-5">
            <label for="formGroupExampleInput2" class="form-label"> القسم الصادر منه</label>
            <select id="dep" name="dep" class="form-select" aria-label=".form-select-sm example">

              <?php foreach ($deps as $deps): ?>
                <option value="<?php echo $deps['dep']; ?>"><?php echo $deps['dep']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="row">
          <div class="col-3 my-2"  > <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popupFormModal">
              اضافة قسم
            </button></div>
            <div class="col-3 my-2 " >
              <a href="showdeletdep.php" class="btn btn-danger">حذف قسم</a>
            </div>
            

        </div>
        <div class="col-3">
          <label for="formGroupExampleInput2" class="form-label">درجة السرية</label>
          <select name="sery" class="form-select" aria-label=".form-select-sm example">
            <option value="سري">سري</option>
            <option value="بدون">بدون </option>
         
          </select>
        </div>




        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">نسخة منه الى</label>
          <textarea rows="4" cols="50" class="form-control" id="formGroupExampleInput2" name="copyto"
            required> </textarea>
        </div>
        <!-- row2 -->
        <div class="row">
          <div class="mb-3 col-6">
            <label for="formGroupExampleInput2" class="form-label">الموضوع</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="topic" required>
          </div>

          <div class="mb-3 col-6">
            <label for="formGroupExampleInput2" class="form-label">رفع الكتاب</label>
            <input type="file" class="form-control" id="formGroupExampleInput2" name="file" required>
          </div>
        </div>
        <!-- row2 -->
        <div class="row">
          <div class="mb-3 col-3">
            <label for="formGroupExampleInput2" class="form-label ">تاريخ اخر تحديث</label>
            <input type="date" class="form-control" id="formGroupExampleInput2" name="updateup"
              value="<?php echo date('Y-m-d'); ?>" required    >
          </div>
          <div class="mb-3 col-3">
            <label for="formGroupExampleInput2" class="form-label">اسم المستخدم</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="username" value="<?php echo $_SESSION['username']?>" required readonly>
          </div>
          <div class="mb-3 col-6">
            <label for="formGroupExampleInput2" class="form-label">الملاحضات</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="notes">
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
        </div>

        <!-- Modal footer -->
        <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit">
        <button type="button" class="btn btn-primary" onclick="submitPopupForm()">Submit</button>
      </div> -->
      </div>
    </div>
  </div>



  <script src="code.jquery.com_jquery-3.7.0.min.js"></script>
  <script src="bootstrap-4.5.3/js/bootstrap.min.js"></script>

  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

  <script>
    function submitPopupForm() {
      // Get form data from the popup form
      var form = document.getElementById('popupFormContent');
      var formData = new FormData(form);

      // Perform AJAX submission using fetch
      fetch('submit_popup_form.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          // Handle the response from the server if needed
          console.log(data);

          // Close the modal after successful submission
          $('#popupFormModal').modal('hide');
        })
        .catch(error => {
          // Handle the error if needed
          console.error(error);
        });
    }
  </script>

</body>

</html>
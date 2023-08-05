<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>تسجيل دخول</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>
    <style> 
    body {
      direction: rtl;
    }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center ">
    <div class="text-center">
    <div class="container center "><img src="assets/2.jpg" alt="Logo" height="300"></div>
<div><h1 class="text-success">نظام ارشفة المستندات والكتب الالكترونية</h1></div>
    </div>
  </div>

    <div class="container ">
    
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-primary">
                    <div class="card-header bg-success text-light">قم بتسجيل الدخول</div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <?php
                            if (isset($_GET['error'])) {
                                echo '<div class="alert alert-danger" role="alert">اسم المستخدم او كلمة المرور غير صحيحة</div>';
                            }
                            ?>
                            <div class="form-group my-1">
                                <label for="username text-light"  class="text-light my-1">اسم المستخدم</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group my-1">
                                <label for="password" class="text-light my-1">كلمة المرور</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-success">دخول</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<?php include("menuandnav.php") ?>


    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- Add an image or a logo here -->
                <img src="assets/2.jpg" alt="Company Logo" height="200">
            </div>
            <div class="col-lg-12 text-center">
                <h1 class="larger-text">حول النظام</h1>
                <h2 class=" text-danger font-weight-bold">
                    برمجة وتصميم المبرمج محمد عزيز
                                </h2>
                <h2 class="larger-text">تواصل معنا</h2>
                <h3 class="text-success font-weight-bold">
                   mohammed.alsraf@gmail.com
                                </h3>
                <h3 class="text-success font-weight-bold">
                   07500134318
                            </h3>
            </div>
        </div>
    </div>

</body>

</html>

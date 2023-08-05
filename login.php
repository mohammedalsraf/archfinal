<?php
session_start();
require("conn.php");
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM userss WHERE username = '$username' and password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // $row = mysqli_fetch_assoc($result);
        
        // $hashedPassword = $row['password'];
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        

        // if (password_verify($password, $hashedPassword)) {
            // Password is correct, redirect to the dashboard page or whatever you want
            header("Location: home.php");
            exit();
        // } else {
        //     // Password is incorrect, redirect back to the login page with an error parameter
        //     header("Location: index.php?error=1");
        //     exit();
        // }
    } else {
        // Username not found, redirect back to the login page with an error parameter
        header("Location: index.php?error=1");
        exit();
    }
}

mysqli_close($conn);
?>

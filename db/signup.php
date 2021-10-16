<?php

include "dbconfig.php";

if (!isset($_POST['submit'])) {
    header("location:../");
} else {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $today = date('Y-m-d');
    $checkuser = mysqli_query($conn, "select * from users");
    while ($row = mysqli_fetch_assoc($checkuser)) {
        if ($row['username'] == $username) {
            $_SESSION['message'] = 'username already exists';
            echo $_SESSION['message'];
            header("location:../");
            exit(0);
        }
        if ($row['email'] == $email) {
            $_SESSION['message'] = 'email already exists';
            header("location:../");
            exit(0);
        }
    }
    $newpassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users(username,email,password,created_at) VALUES (?, ?, ?,?) ");
    $stmt->bind_param("ssss", $username, $email, $newpassword, $today);
    if ($stmt->execute()) {
        $_SESSION['message'] = 'signup successful, please login!';
        header("location:../");
    } else {
        $_SESSION['message'] = 'something went wrong, please try again!';
    }
}

<?php
include "dbconfig.php";
if(!isset($_POST['addexpense'])){
    header("location:../");
}else{
    $amount = mysqli_real_escape_string($conn, trim($_POST['amount']));
    $catid = mysqli_real_escape_string($conn, trim($_POST['category']));
    $description = preg_replace('/\n+/', "\n", trim( $_POST['description']));
    $date=date('Y-m-d');
    $userid=$_SESSION['user'];

    $stmt=$conn->prepare("INSERT INTO expenses(cat_id,user_id,amount,description,created_at) VALUES(?,?,?,?,?)");
    $stmt->bind_param("iiiss",$catid,$userid,$amount,$description,$date);
    if($stmt->execute()){
        header("location:../addexpense.php?m=expense added successfully");
    }else{
        header("location:../addexpense.php?m=something went wrong!");
    }
}
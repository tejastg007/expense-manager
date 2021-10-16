<?php
include "dbconfig.php";
if(!isset($_POST['submit'])){
    header("location:../");
}else{
    $category = mysqli_real_escape_string($conn, trim($_POST['category']));
    $userid=$_SESSION['user'];
    $date=date('Y-m-d');
    $stmt=$conn->prepare("INSERT INTO category (cat_name,user_id,created_at) VALUES(?,?,?)" );
    $stmt->bind_param("sis",$category,$userid,$date);
    if($stmt->execute()){
        header("location:../categories.php?m=category added");
    }else{
        header("location:../categories.php?m=something went wrong");
    }
}

?>
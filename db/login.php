<?php
include "dbconfig.php";

if(!isset($_POST['submit'])){
    header("location:../");
}else{
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $userresult=mysqli_query($conn,"select * from users where username='$username'");
    if(mysqli_num_rows($userresult)==0){
        $_SESSION['message']='no user found, please register !';
        header("location:../");
    }else{
        while($row=mysqli_fetch_assoc($userresult)){
            if(password_verify($password,$row['password'])){
                $_SESSION['user']=$row['id'];
                header("location:../dashboard.php");
            }else{
                $_SESSION['message']="wrong credentials !";
                header("location:../");
            }
        }
    }
}

<?php
include 'dbconfig.php';
if (!isset($_POST['updateprofile']) && !isset($_POST['updatepassword'])) {
    header("location:../");
    exit(0);
} else {
    if (isset($_POST['updateprofile'])) {
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        
        $checkusername=mysqli_query($conn,"select * from users where id <> '".$_SESSION['user']."' && (username = '$username' || email='$email' )" );
        if( mysqli_num_rows($checkusername)>0){
            header("location:../profile.php?m=username or email already exists");
            exit(0);
        }
        $stmt=$conn->prepare("UPDATE users SET email=? , username=? WHERE id=?");
        $stmt->bind_param("ssi",$email,$username,$_SESSION['user']);
        if($stmt->execute()){
            header("location:../profile.php?m=profile updated successfully");
        }else{
            header("location:../profile.php?m=something went wrong");
        }
    }
    elseif(isset($_POST['updatepassword'])){
        $oldpass= mysqli_real_escape_string($conn, $_POST['oldpassword']);
        $newpass= mysqli_real_escape_string($conn, $_POST['newpassword']);
        $user=mysqli_query($conn,"SELECT * FROM users WHERE id='".$_SESSION['user']."' LIMIT 1");
        while($row=mysqli_fetch_assoc($user)){
            if(password_verify($oldpass,$row['password'])){
                $stmt=$conn->prepare("UPDATE users SET password=? where id=?");
                $stmt->bind_param("si",password_hash($newpass,PASSWORD_BCRYPT),$_SESSION['user']);
                if($stmt->execute()){
                    header("location:../profile.php?m=password updated successfully");
                }else{
                    header("location:../profile.php?m=something went wrong");
                }
            }else{
                header("location:../profile.php?m=old password is wrong");
            }
        }
    }else{
        
    }
}

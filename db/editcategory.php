<?php
include "dbconfig.php";
if(!isset($_POST['editcategory'])){
    header("location:../");
}else{
   $catid= mysqli_real_escape_string($conn, trim($_POST['catid']));
   $catname= mysqli_real_escape_string($conn, trim($_POST['catname']));
   $stmt=$conn->prepare("UPDATE category set cat_name=? where id=?");
   $stmt->bind_param('si',$catname,$catid);
   if($stmt->execute()){
       header("location:../editcategory.php?id=".$catid."&m=category updated successfully");
    }else{
       header("location:../editcategory.php?id=".$catid."&m=something went wrong");
   }

}
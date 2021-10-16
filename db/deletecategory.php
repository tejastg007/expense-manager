<?php
include "dbconfig.php";
if (!isset($_GET['id'])) {
    header("location:../");
} else {
    $catid = mysqli_real_escape_string($conn, $_GET['id']);
    $catcheck = mysqli_query($conn, "SELECT * from category where id='$catid' && user_id='" . $_SESSION['user'] . "' LIMIT 1");
    if (mysqli_num_rows($catcheck) > 0) {
        $checkexpenses = mysqli_query($conn, "SELECT * from expenses where cat_id='$catid' && user_id='" . $_SESSION['user'] . "'");
        if (mysqli_num_rows($checkexpenses) > 0) {
            header("location:../categories.php?m=category can't be deleted if having expense records!");
        } else {
            mysqli_query($conn, "delete from category where id='$catid' && user_id='" . $_SESSION['user'] . "'");
            header("location:../categories.php?m=category deleted successfully!");
        }
    } else {
        header("location:../categories.php");
    }
}

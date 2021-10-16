<?php
include "dbconfig.php";
if (!isset($_POST['editexpense'])) {
    header("location:../");
} else {
    $expenseid = mysqli_real_escape_string($conn, trim($_POST['expenseid']));
    $amount = mysqli_real_escape_string($conn, trim($_POST['amount']));
    $category = mysqli_real_escape_string($conn, trim($_POST['category']));
    $description = preg_replace('/\n+/', "\n", trim( $_POST['description']));
    
    $stmt = $conn->prepare("UPDATE expenses set  cat_id=?,amount=?,description=? where id=?");
    $stmt->bind_param('iisi', $category, $amount, $description, $expenseid);
    if ($stmt->execute()) {
        header("Location:../editexpense.php?id=" . $expenseid . "&m=expense details updated successfully");
    } else {
        header("location:../editexpense.php?id=" . $expenseid . "&m=something went wrong");
    }
}

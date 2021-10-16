<?php
include "dbconfig.php";
if (!isset($_GET['id']) && !isset($_POST['bulkdelete'])) {
    header("Location:../");
} else {
    if (isset($_GET['id'])) {
        $expenseid = $_GET['id'];
        $query = mysqli_query($conn, "delete from expenses where id='$expenseid' && user_id='" . $_SESSION['user'] . "'");
        header("location:../expenses.php");
    }
    if (isset($_POST['bulkdelete'])) {
        $checks = $_POST['checkbox'];
        // print_r($checks);
        for ($i = 0; $i < count($checks); $i++) {
            mysqli_query($conn, "DELETE from expenses where id='" . $checks[$i] . "' && user_id='" . $_SESSION['user'] . "'");
        }
        header("location:../expenses.php");
    }
}

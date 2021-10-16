<?php include "./includes/header.php";
$user = mysqli_query($conn, "select * from users where id='" . $_SESSION['user'] . "'");
while ($row = mysqli_fetch_assoc($user)) {
    $username = $row['username'];
    $email = $row['email'];
}
?>

<body>
    <div class="container">
    <?php include "./includes/left.php" ?>


        <div class="right">
            <div class="page">

                <h1>profile</h1>
                <div class="content profile">
                    <form action="db/updateprofile.php" method="post" class="profile-form">

                        <?php
                        if (isset($_GET['m'])) {
                        ?>
                            <div class="error">
                                <p> <?php echo $_GET['m'];
                                    ?></p>
                                <i class="fas fa-times" onclick="closeerror()"></i>
                            </div>
                        <?php } ?>

                        <label for="">username : </label>
                        <input type="text" name="username" class="input" value="<?php echo $username ?>" required>
                        <label for="">email : </label>
                        <input type="email" name="email" class="input" value="<?php echo $email ?>" required>
                        <input type="submit" class="input" value='Update' name="updateprofile">
                    </form>
                    <form action="db/updateprofile.php" method="post" class="profile-form">
                        <label for="">old password : </label>
                        <input type="password" name="oldpassword" class="input" required>
                        <label for="">new password : </label>
                        <input type="password" name="newpassword" class="input">
                        <input type="submit" class="input" value='Update' name="updatepassword" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
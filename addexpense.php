<?php include "./includes/header.php";
$categories = mysqli_query($conn, "select * from category where user_id='" . $_SESSION['user'] . "'");

?>

<body>
    <div class="container">
    <?php include "./includes/left.php" ?>


        <div class="right">
            <div class="page">
                <h1>add expenses</h1>
                <div class="content add-expense">
                    <form action="db/addexpense.php" method="post">
                        <?php
                        if (isset($_GET['m'])) {
                        ?>
                            <div class="error">
                                <p> <?php echo $_GET['m'];
                                    ?></p>
                                <i class="fas fa-times" onclick="closeerror()"></i>
                            </div>
                        <?php } ?>

                        <label for="">expense amount : </label>
                        <input type="number" class='input' name="amount" required>
                        <label for="">category :</label>
                        <select name="category" id="category" class='input' required>
                            <option value="" selected disabled>select category</option>
                            <?php
                            if (mysqli_num_rows($categories) > 0) {
                                while ($row = mysqli_fetch_assoc($categories)) {
                            ?>
                                    <option value="<?= $row['id'] ?>"> <?= $row['cat_name'] ?> </option>
                            <?php
                                }
                            } ?>
                        </select>
                        <label for="">description : (optional)</label>
                        <textarea name="description" id="description" rows="3" class='input'></textarea>
                        <input type="submit" value="Add" class='input' name='addexpense'>
                        <a href="expenses.php">
                            << back to expense list</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
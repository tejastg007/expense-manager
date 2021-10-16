<?php include "./includes/header.php";
if (!isset($_GET['id'])) {
    header("Location:expenses.php");
} else {
    $id = $_GET['id'];
    $expenses = mysqli_query($conn, "SELECT * FROM expenses WHERE id='$id' && user_id='" . $_SESSION['user'] . "' LIMIT 1");
    if (mysqli_num_rows($expenses) == 0) {
        header("location:expenses.php");
    } else {
        while ($row = mysqli_fetch_assoc($expenses)) {
            $amount = $row['amount'];
            $category = $row['cat_id'];
            $description = $row['description'];
        }
    }
}
?>

<body>
    <div class="container">
    <?php include "./includes/left.php" ?>


        <div class="right">
            <div class="page ">
                <h1>edit expense</h1>
                <div class="content editexpense">
                    <form action="db/editexpense.php" method="post">
                        <?php
                        if (isset($_GET['m'])) {
                        ?>
                            <div class="error">
                                <p> <?php echo $_GET['m'];
                                    ?></p>
                                <i class="fas fa-times" onclick="closeerror()"></i>
                            </div>
                        <?php } ?>
                        <input type="number" name='expenseid' value='<?= $id ?>' hidden>
                        <label for="">expense amount : </label>
                        <input type="number" class='input' name="amount" value='<?= $amount ?>' required>
                        <label for="">category :</label>
                        <select name="category" id="category" class='input' required>
                            <option value="" selected disabled>select category</option>
                            <?php
                            $categories = mysqli_query($conn, "select * from category where user_id='" . $_SESSION['user'] . "'");
                            if (mysqli_num_rows($categories) > 0) {
                                while ($row = mysqli_fetch_assoc($categories)) {
                            ?>
                                    <option value="<?= $row['id'] ?>" <?php if ($category == $row['id']) echo "selected" ?>>
                                        <?= $row['cat_name'] ?> </option>
                            <?php
                                }
                            } ?>
                        </select>
                        <label for="">description : (optional)</label>
                        <textarea name="description" id="description" rows="3" class='input'><?= $description ?></textarea>
                        <input type="submit" value="Update" class='input' name='editexpense'>
                        <a href="expenses.php">
                            << back to expense list</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
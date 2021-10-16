<?php include "./includes/header.php";
if(!isset($_GET['id'])){
    header("location:categories.php");
}else{
    $catid=$_GET['id'];
    $catresult=mysqli_query($conn,"SELECT * FROM category WHERE id='$catid' && user_id='".$_SESSION['user']."' LIMIT 1");
    if(mysqli_num_rows($catresult)==0){
        header("location:categories.php?m=no data found");
    }else{
        while($row=mysqli_fetch_assoc($catresult)){
            $catname=$row['cat_name'];
        }
    }
}
?>

<body>
    <div class="container">
    <?php include "./includes/left.php" ?>


        <div class="right">
            <div class="page ">
                <h1>edit category</h1>
                <?php
                if (isset($_GET['m'])) {
                ?>
                    <div class="error">
                        <p> <?php echo $_GET['m'];
                            ?></p>
                        <i class="fas fa-times" onclick="closeerror()"></i>
                    </div>
                <?php } ?>
                <div class="content editcategory">
                    <form action="db/editcategory.php" method="post">
                        <input type="number" name="catid" hidden value="<?= $_GET['id']?>">
                        <input type="text" class="input" name='catname' value="<?= $catname ?>" required>
                        <input type="submit" class="input submit" name='editcategory' value="Update">
                        <a href="categories.php">< back to categories</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
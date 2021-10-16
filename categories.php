<?php include "./includes/header.php" ?>

<body>
    <div class="container">
    <?php include "./includes/left.php" ?>


        <div class="right">
            <div class="page">
                <h1>Categories</h1>
                
                <?php
                        if (isset($_GET['m'])) {
                        ?>
                            <div class="error">
                                <p> <?php echo $_GET['m'];
                                    ?></p>
                                <i class="fas fa-times" onclick="closeerror()"></i>
                            </div>
                        <?php } ?>
                        
                <div class="content categories">
                    <div class='cat-container'>
                        <h3>Your categories</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>category</th>
                                        <th>date created</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $categories = mysqli_query($conn, "select * from category where user_id='" . $_SESSION['user'] . "'");
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($categories)) {
                                        $i++;
                                        $date = DateTime::createFromFormat('Y-m-d', $row['created_at']);
                                        $date = $date->format('d M Y');
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row['cat_name'] ?></td>
                                            <td><?= $date ?></td>
                                            <td>
                                                <a href="editcategory.php?id=<?php echo $row['id'] ?>" class="btn btn-sm">edit</a>
                                                <a onclick="confirmdelete(event)" href="db/deletecategory.php?id=<?php echo $row['id'] ?>" class="btn btn-sm danger">delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cat-container">
                        <form action="db/addcategory.php" class="add-category" method="post">
                            <div>
                                <h3>Add category</h3>
                                <input type="text" name="category" class='input' placeholder='eg. grocery, stationary etc.' autofocus required>
                                <input type="submit" value='Save' class="input submit" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>

    </script>
    <?php include "includes/footer.php" ?>
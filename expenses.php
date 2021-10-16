<?php include "./includes/header.php" ?>

<body>
    <div class="container">
    <?php include "./includes/left.php" ?>


        <div class="right">
            <div class="page ">
                <h1>your expenses</h1>
                <div class="content expenses">
                    <a href="addexpense.php" class='btn success add-expense-btn'>add expense</a>
                    <form action="db/deleteexpense.php" method='post' onsubmit="return validateexpenseform()">
                        <input type="submit" value="delete" class='input btn danger' name='bulkdelete'>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" onclick="selectallcheckbox(this)">
                                    </th>
                                    <th>sr</th>
                                    <th>amount (Rs)</th>
                                    <th>category</th>
                                    <th>date</th>
                                    <th>description</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select e.id,e.amount,e.description,e.created_at,c.cat_name FROM expenses as e LEFT JOIN category as c on e.cat_id=c.id where e.user_id='" . $_SESSION['user'] . "'";
                                $expenses = mysqli_query($conn, $query);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($expenses)) {
                                    $i++;
                                    $date = DateTime::createFromFormat('Y-m-d', $row['created_at']);
                                    $date = $date->format('d M Y');
                                ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="checkbox[]" class='checkbox' value="<?= $row['id'] ?>">
                                        </td>
                                        <td><?= $i ?></td>
                                        <td><?= $row['amount'] ?></td>
                                        <td><?= $row['cat_name'] ?></td>
                                        <td><?= $date ?></td>
                                        <td><?= $row['description'] ?></td>
                                        <td>
                                            <a href="editexpense.php?id=<?= $row['id'] ?>" class='btn btn-sm success'>edit</a>
                                            <a onclick="confirmdelete(event)" href="db/deleteexpense.php?id=<?= $row['id'] ?>" class='btn btn-sm danger'>delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateexpenseform() {
            var count=0;
            var checks = document.getElementsByClassName('checkbox');
            for (var i = 0; i < checks.length; i++) {
                if (checks[i].checked)
                    count++;
            }
            if(count>0){
                if(confirm('are you sure to delete records?')==false){
                    return false;
                }
                return true;
            }
            alert('no record is seleceted');
            return false;
        }

        function selectallcheckbox(source) {
            var checks = document.getElementsByClassName('checkbox');
            for (var i = 0; i < checks.length; i++) {
                checks[i].checked=source.checked
            }
        }
    </script>
    <?php include "includes/footer.php" ?>
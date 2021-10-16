<?php 
session_start();
if(isset($_SESSION['user'])){
    header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense manager</title>
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class="error">
                    <p> <?php echo $_SESSION['message'];
                        session_destroy();
                    ?></p>
                    <i class="fas fa-times" onclick="closeerror()"></i>
                </div>
                <?php } ?>

            <div class="buttons">
                <button class='tab-btn' onclick="openform(event,'signup')" id='default'>signup</button>
                <button class='tab-btn' onclick="openform(event,'login')">login</button>
            </div>
            <div class="signup-form form" id='signup'>
                <h3>signup</h3>
                <form name="signup" action="db/signup.php" method="post" onsubmit='return validatesignup()'>
                    <label for="">username :</label>
                    <input type="text" name='username' required>
                    <label for="">email :</label>
                    <input type="email" name='email' required>
                    <label for="">password :</label>
                    <input type="password" name='password' required>
                    <label for="">confirm password :</label>
                    <input type="password" name='cpassword'>
                    <input type="submit" value="signup" name="submit">
                </form>
            </div>
            <div class="login-form form" id='login'>
                <h3>login</h3>
                <form action="db/login.php" method="post">
                    <label for="">username :</label>
                    <input type="text" name="username" required>
                    <label for="">password :</label>
                    <input type="password" name="password" required>
                    <input type="submit" value="login" name="submit">
                </form>
            </div>
        </div>
    </div>

    <script>
        function openform(e, formname) {
            var i, form, tabBtn;
            forms = document.getElementsByClassName("form");
            for (i = 0; i < forms.length; i++) {
                document.getElementsByClassName("form")[i].style.display = 'none'
            }
            tabBtn = document.getElementsByClassName('tab-btn');
            for (i = 0; i < tabBtn.length; i++) {
                tabBtn[i].classList.remove('active');
            }
            document.getElementById(formname).style.display = 'block';
            e.currentTarget.classList.add('active');
        }
        document.getElementById("default").click();
    </script>
    <script>
        function validatesignup() {
            if (document.forms['signup']['password'].value != document.forms['signup']['cpassword'].value) {
                alert("confirm password doesn't match")
                return false;
            }
            return true;
        }

        function closeerror() {
            document.getElementsByClassName('error')[0].style.display = 'none'
        }
    </script>
    <?php include "includes/footer.php" ?>
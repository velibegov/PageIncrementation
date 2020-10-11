<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Increment Page</title>
    <style>
        @import "css/style.css";
    </style>
</head>
<body>
<form class="central_form" action="login.php" method="post">
    <p>Login:
        <input type="text" name="username" placeholder="User name" required>
        Password:
        <input type="password" name="password" placeholder="Enter your password" required>
    </p>
    <button name="login">Sign in</button>
</form>

<form class="button" action="registration.php" method="post">
    <button name="register">Register</button>
</form>

<div class="warning_msg">
    <h1>
        <?php
        if (isset($_SESSION["msg"])) {
            echo $_SESSION['msg'];
        }
        unset($_SESSION['msg']);
        ?>
    </h1>
</div>
</body>
</html>

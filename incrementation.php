<?php
require 'dbConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Incrementation Page</title>
    <style>
        @import "css/style.css";
    </style>
</head>
<body>
<div class="increment_form">
    <?php
    $counter = 0;
    if (isset($_SESSION['user'])) {
        $stmt = $dbh->prepare('SELECT count FROM pageDB.users WHERE login = :login');
        $stmt->bindParam(':login', $_SESSION['user']);
        $stmt->execute();
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        $counter = $arr['count'];
        echo $counter;
    } else {
        header('Location: index.php');
    }
    if (isset($_POST['exit'])) {
        unset($_SESSION['user']);
    }
    if (isset($_POST['increment'])) {
        $counter++;
        $stmtInc = $dbh->prepare('UPDATE pageDB.users SET count = :count WHERE login = :login');
        $data = ['count' => $counter,
            'login' => $_SESSION['user']];
        $stmtInc->execute($data);
        header('Location: incrementation.php');
    }
    ?>
</div>
<form class="central_form" action="incrementation.php" method="post">
    <button class="increment_button" name="increment" type="submit" value="+1">+1</button>
</form>
<form class="central_form" action="index.php" method="post">
    <button class="exit_button" name="exit" type="submit" value="Exit">Exit</button>
</form>
</body>
</html>

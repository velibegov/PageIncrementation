<?php
require_once 'dbConnection.php';

$warningMsg = '';

$d = $_POST['day_of_birth'];
$m = $_POST['month_of_birth'];
$y = $_POST['year_of_birth'];

$login = htmlspecialchars($_POST['username']);

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$currentDate = new DateTime();

$clientBirthDate = new DateTime("$y-$m-$d");


if (($currentDate->diff($clientBirthDate))->format("%Y") < 5) {
    $warningMsg = "Too young!";
}
if (($currentDate->diff($clientBirthDate))->format("%Y") > 150) {
    $warningMsg = "Too old!";
}
if (!checkdate($m, $d, $y)) {
    $warningMsg = "Wrong date";
}

if (!empty($warningMsg)) {
    $_SESSION['msg'] = $warningMsg;
    header("Location: index.php");
} else {
    $stmtValidation = $dbh->prepare('SELECT * FROM pageDB.users WHERE login = :login');
    $stmtValidation->bindParam(':login', $login);
    $stmtValidation->execute();
    if ($stmtValidation->rowCount() > 0) {
        $warningMsg = "Login is already in use";
        $_SESSION['msg'] = $warningMsg;
        header("Location: index.php");
    } else {
        $clientBirthDate = $clientBirthDate->format('Y-m-d');
        $stmtInsert = $dbh->prepare('INSERT INTO pageDB.users (login, password, birthday)
        VALUES (:login, :password, :birthdate)');
        $stmtInsert->bindParam(':login', $login);
        $stmtInsert->bindParam(':password', $password);
        $stmtInsert->bindParam(':birthdate', $clientBirthDate);
        $stmtInsert->execute();
        $_SESSION['user'] = $login;
        header("Location: incrementation.php");
    }
}

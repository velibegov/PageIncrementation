<?php
require_once 'dbConnection.php';

$login = $_POST['username'];
$password = $_POST['password'];

$stmtValidation = $dbh->prepare('SELECT * FROM pageDB.users WHERE login = :login');
$stmtValidation->bindParam(':login', $login);
$stmtValidation->execute();
$arr = $stmtValidation->fetch(PDO::FETCH_ASSOC);
if ($stmtValidation->rowCount() > 0 && password_verify($password, $arr['password'])) {
    $_SESSION['user'] = $login;
    header("Location: incrementation.php");
}
else {
    $_SESSION['msg'] = "User is not found";
    header("Location: index.php");
}
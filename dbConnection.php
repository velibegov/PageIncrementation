<?php
session_start();

$config = parse_ini_file('conf/config.ini');
$driver = $config['driver'];
$host = $config['host'];
$port = $config['port'];
$dbname = $config['dbname'];
$charset = $config['charset'];
$username = $config['username'];
$password = $config['password'];

$dbh = new PDO("$driver:host=$host;port=$port;dbname=$dbname;charset=$charset",
    $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

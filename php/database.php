<?php

$dsn = "mysql:host=localhost;dbname=<name of your user db>";
$dbusername = "";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection success!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
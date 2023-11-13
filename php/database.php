<?php

//This file performs a database connection to a specified database
//This is "included" before each database query

//MUST CHANGE THESE PARAMETERS TO MATCH YOU LOCAL DB
$dsn = "mysql:host=localhost;dbname=<name of your db>";
$dbusername = "";
$dbpassword = "";

//Attempt a connection to the database, if it fails, print the error message to the terminal.
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection success!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
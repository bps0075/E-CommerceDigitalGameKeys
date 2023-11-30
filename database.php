<?php

//This file performs a database connection to a specified database
//This is "included" before each database query

//MUST CHANGE THESE PARAMETERS TO MATCH YOU LOCAL DB
$dsn = "mysql:host=localhost;dbname=steamkeysapplication";
$dbusername = "root";
$dbpassword = "";

//Attempt a connection to the database, if it fails, print the error message to the terminal.
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
<?php

if ($_SERVER(["REQUEST_METHOD"] == "POST")) {
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwd2 = $_POST["confirm_password"];

    try {
        require_once "database.php";

        $query = "INSERT INTO users (email, password) VALUES (?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$email, $pwd]);

        $pdo = null;
        $stmt = null;
        die();

    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ..\html\homepage");
}
<?php

$dbhost = "localhost:3308";
$dbuser = "root";
$dbpass = "";
$dbname = "pdo_toets";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Database connection problem. " . $err->getMessage();
    exit();
}

?>

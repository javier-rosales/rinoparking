<?php

$host = "localhost";
$database = "rinopark_rinoparking";
$user = "rinopark_rinouser";
$password = "trarpdb10";

try {
    $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
} catch(PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
}
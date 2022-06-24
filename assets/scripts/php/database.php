<?php
/*
$host = "localhost";
$database = "rinopark_rinoparking";
$user = "rinopark_rinouser";
$password = "trarpdb10";
*/
$host = "localhost";
$database = "rinoparking";
$user = "root";
$password = "";

try {
    $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
} catch(PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
}
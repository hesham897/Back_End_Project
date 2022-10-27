<?php

session_start();
require_once 'config.php';

$db_servername = "localhost";
$db_username = "root";
// $db_password = "root";
$db_name = "blog";

try {
    $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

define('SITE_URL', 'http://giz.test/');

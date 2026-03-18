<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sumanyu_ortho";

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

// Note: In a real app, we'd run the migration properly. 
// For this demo, let's assume the tables from database.sql are created.
?>

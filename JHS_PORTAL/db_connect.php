<?php
$servername = "localhost"; // or your DB host
$username = "root";
$password = "";
$dbname = "jhs_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?> 
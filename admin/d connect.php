<?php
// db_connection.php
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "travel_agency";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

<?php
// signup.php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful. Please log in.";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: index.php");
    }
    $stmt->close();
    $conn->close();
}

<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$messageSent = false;
$errorMessage = '';
$errors = [];
$name = '';
$email = '';
$subject = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        if (ctype_alpha(str_replace(" ", "", $name)) === false) {
            $errors[] = "Name should only contain alphabets and spaces.";
        }
    } else {
        $errors[] = "Name cannot be empty.";
    }

    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = "Email is not valid.";
        }
    } else {
        $errors[] = "Email cannot be empty.";
    }

    if (!empty($_POST['subject'])) {
        $subject = htmlspecialchars($_POST['subject']);
    } else {
        $errors[] = "Subject cannot be empty.";
    }

    if (!empty($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
    } else {
        $errors[] = "Message cannot be empty.";
    }

    // Redirect if there are validation errors
    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header("Location: contact.php?result=validation_error");
        exit();
    }

    // Prepare the email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = '3d950ec299a3be';
        $mail->Password   = '5bc0403e7c9f1c';
        $mail->Port       = 2525;

        $mail->setFrom('ucheorji555@gmail.com', 'Mailer');
        $mail->addAddress('iamuche0011@gmail.com', 'Joe User');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";

        $mail->send();
        $_SESSION['messagestatus'] = 'success';
        header("Location: contact.php?result=mailer_success");
    } catch (Exception $e) {
        $_SESSION['messagestatus'] = 'error';
        $_SESSION['messageerrors'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: contact.php?result=mailer_error");
    }
    exit();
} else {
    header("Location: contact.php");
    exit();
}

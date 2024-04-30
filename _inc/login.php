<?php
include_once("config.php");

$session = new Session();
$admin = new Admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (isset($_POST['REGISTER'])) {
        // Handle registration
        if ($admin->register($login, $password)) {
            echo "Registered successfully!";
            $session->setValue('logged', true);
            // Redirect or further processing
            header("Location: ../templates/admin.php");
            exit();
        } else {
            echo "Registration failed!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } elseif (isset($_POST['LOGIN'])) {
        // Handle login
        if ($admin->authenticate($login, $password)) {
            $session->setValue('logged', true); // Set session variable
            echo "Login successful!";
            header("Location: ../templates/admin.php");
            exit();
            // Redirect or further processing
        } else {
            echo "Login failed!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>

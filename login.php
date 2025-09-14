<?php
session_start();
require 'db.php';

// Enable error reporting (for development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "", "vibescapedb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email_or_username = trim($_POST['email']);
    $password = $_POST['password'];

    // Get user data including role
    $stmt = $conn->prepare("SELECT id, email, name, password, role FROM users WHERE email = ? OR name = ?");
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: ../admin/dashboard.php"); // Admin dashboard
            } else {
                header("Location: ../view/home.php"); // Regular user home
            }
            exit();
        } else {
            header("Location: ../frontend/login-view.php?error=invalid-password");
            exit();
        }
    } else {
        header("Location: ../frontend/login-view.php?error=user-not-found");
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../frontend/login-view.php?error=missing-fields");
    exit();
}

$conn->close();
?>

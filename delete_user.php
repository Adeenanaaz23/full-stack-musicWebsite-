<?php
$conn = new mysqli("localhost", "root", "", "vibescapedb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  // Always cast to int to prevent SQL injection

    // Soft delete (change status to inactive)
    $sql = "UPDATE users SET status = 'inactive' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_users.php?deleted=1");
        exit();
    } else {
        header("Location: manage_users.php?deleted=0");
        exit();
    }
} else {
    // No ID provided
    header("Location: manage_users.php?deleted=0");
    exit();
}
?>

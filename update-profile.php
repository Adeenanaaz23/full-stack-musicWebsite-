<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "vibescapedb");
if (!$conn) {
    die("DB Connection failed: " . mysqli_connect_error());
}

$userEmail = $_SESSION['email']; // logged-in user
$newName = $_POST['name'];
$newEmail = $_POST['email'];

$sql = "UPDATE users SET name='$newName', email='$newEmail' WHERE email='$userEmail'";
if (mysqli_query($conn, $sql)) {
    $_SESSION['email'] = $newEmail;
    $_SESSION['name'] = $newName;
    echo "success";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}
?>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "vibescapedb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (user_id, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $rating, $comment);

    if ($stmt->execute()) {
        header("Location: ../view/review_form.php?success=1");
    } else {
        header("Location: ../view/review_form.php?error=1");
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

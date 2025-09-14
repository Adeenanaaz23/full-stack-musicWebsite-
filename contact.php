<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Example: Save to DB
    $conn = mysqli_connect("localhost", "root", "", "vibescapedb");
    if (!$conn) {
        echo "Database connection failed!";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Something went wrong!";
    }

    $stmt->close();
    $conn->close();
}
?>

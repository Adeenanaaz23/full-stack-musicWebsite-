<?php
require '../backend/db.php';

$userId = $_POST['user_id'];

$stmt = $conn->prepare("UPDATE users SET subscription_status = 'cancelled' WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();

header("Location: manage_subscriptions.php");
exit;

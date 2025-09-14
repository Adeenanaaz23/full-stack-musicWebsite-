<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
  die("Unauthorized");
}

$plan = $_POST['plan'];
$userId = $_SESSION['user_id'];

// Insert into subscriptions table or update user plan
$stmt = $conn->prepare("UPDATE users SET subscription_plan = ? WHERE id = ?");
$stmt->bind_param("si", $plan, $userId);
$stmt->execute();

header("Location: ../view/premium.php?subscribed=$plan");
exit();

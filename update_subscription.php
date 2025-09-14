<?php
require 'db.php';

$userId = $_POST['user_id'];
$action = $_POST['action'];

if ($action === 'cancel') {
    $stmt = $conn->prepare("UPDATE users SET subscription_status = 'cancelled' WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

} elseif ($action === 'activate') {
    $stmt = $conn->prepare("UPDATE users SET subscription_status = 'active', subscription_date = NOW() WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

} elseif ($action === 'change' && isset($_POST['new_plan'])) {
    $newPlan = $_POST['new_plan'];
    $stmt = $conn->prepare("UPDATE users SET subscription_plan = ?, subscription_date = NOW() WHERE id = ?");
    $stmt->bind_param("si", $newPlan, $userId);
    $stmt->execute();
}

header("Location: ../admin/manage_subscriptions.php");
exit;

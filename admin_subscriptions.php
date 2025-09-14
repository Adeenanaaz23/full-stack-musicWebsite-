<?php
session_start();
require '../backend/db.php';

// Access control: Only admins
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

// Fetch users and subscription data
$result = $conn->query("SELECT id, name, email, subscription_plan, subscription_status, subscription_date FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Subscriptions</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #111;
            color: white;
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #1db954;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            color: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background: #1e1e1e;
        }
        .btn {
            padding: 6px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 13px;
        }
        .cancel { background: #e74c3c; color: white; }
        .activate { background: #2ecc71; color: white; }
        .change { background: #f1c40f; color: black; }
        select {
            padding: 4px;
            border-radius: 5px;
        }
        form {
            display: inline-block;
            margin: 2px;
        }
    </style>
</head>
<body>
    <h2>All User Subscriptions</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Plan</th>
            <th>Status</th>
            <th>Subscribed On</th>
            <th>Actions</th>
        </tr>
        <?php while($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['subscription_plan'] ?? 'None' ?></td>
            <td><?= $user['subscription_status'] ?? 'N/A' ?></td>
            <td><?= $user['subscription_date'] ?? '-' ?></td>
            <td>
                <!-- Change Plan Form -->
                <form action="../backend/update_subscription.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <select name="new_plan">
                        <option value="Basic" <?= $user['subscription_plan'] === 'Basic' ? 'selected' : '' ?>>Basic</option>
                        <option value="Standard" <?= $user['subscription_plan'] === 'Standard' ? 'selected' : '' ?>>Standard</option>
                        <option value="Premium" <?= $user['subscription_plan'] === 'Premium' ? 'selected' : '' ?>>Premium</option>
                    </select>
                    <button class="btn change" name="action" value="change">Change</button>
                </form>

                <!-- Cancel/Activate Subscription -->
                <form action="../backend/update_subscription.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <?php if ($user['subscription_status'] === 'active'): ?>
                        <button class="btn cancel" name="action" value="cancel">Cancel</button>
                    <?php else: ?>
                        <button class="btn activate" name="action" value="activate">Reactivate</button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

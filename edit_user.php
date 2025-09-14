<?php
session_start();
$conn = new mysqli("localhost", "root", "", "vibescapedb");

// Get user data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $user = $result->fetch_assoc();
}

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $role   = $_POST['role'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=?, status=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $role, $status, $id);

    if ($stmt->execute()) {
        header("Location: manage_users.php?updated=1");
    } else {
        header("Location: manage_users.php?updated=0");
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        :root {
            --bg-primary: #111111;
            --bg-secondary: #1b1b1b;
            --green: #1db954;
            --green-dark: #169c47;
            --text-main: #eaeaea;
            --text-muted: #999;
            --border-color: #2e2e2e;
            --radius: 6px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: var(--bg-secondary);
            padding: 30px;
            border-radius: var(--radius);
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            color: var(--green);
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            background-color: #222;
            color: var(--text-main);
        }

        input[type="submit"] {
            background-color: var(--green);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: var(--green-dark);
        }

        .alert {
            background-color: #1d1d1d;
            border-left: 6px solid var(--green);
            padding: 12px 18px;
            margin-bottom: 20px;
            border-radius: var(--radius);
            color: var(--text-main);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit User</h2>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">

            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label>Role</label>
            <select name="role">
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            </select>

            <label>Status</label>
            <select name="status">
                <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>

            <input type="submit" value="Update User">
        </form>
    </div>
</body>
</html>

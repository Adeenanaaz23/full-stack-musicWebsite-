<?php

if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
  <div class="alert"> User updated successfully.</div>
<?php elseif (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
  <div class="alert"> User deactivated (soft-deleted).</div>
<?php elseif (isset($_GET['updated']) && $_GET['updated'] == 0): ?>
  <div class="alert"> Failed to update user.</div>
<?php endif;

$conn = new mysqli("localhost", "root", "", "vibescapedb");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, role, status FROM users";
$result = $conn->query($sql);



$conn = new mysqli("localhost", "root", "", "vibescapedb");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, role, status FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Manage Users</title>
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
      margin: 0;
      padding: 40px 20px;
    }

    h2 {
      text-align: center;
      color: var(--green);
      margin-bottom: 30px;
    }

    .table-container {
      max-width: 1000px;
      margin: 0 auto;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: var(--bg-secondary);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    thead {
      background-color: var(--bg-secondary);
    }

    th,
    td {
      padding: 16px;
      border-bottom: 1px solid var(--border-color);
      text-align: left;
      font-size: 15px;
    }

    th {
      color: var(--green);
      font-weight: 600;
    }

    tbody tr:hover {
      background-color: #222;
    }

    td a {
      color: var(--green);
      text-decoration: none;
      margin-right: 15px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    td a:hover {
      color: var(--green-dark);
    }

    .back-button {
      display: inline-block;
      margin-top: 20px;
      color: white;
      padding: 10px 16px;
      border-radius: var(--radius);
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .back-button:hover {
      color: var(--green-dark);
    }

    @media (max-width: 768px) {

      th,
      td {
        font-size: 13px;
        padding: 12px;
      }
    }
  </style>
</head>
<body>

  <h2>Manage Users</h2>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= ucfirst($row['role']) ?></td>
              <td><?= ucfirst($row['status']) ?></td>
              <td>
                <a href="edit_user.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete_user.php?id=<?= $row['id'] ?>"
                  onclick="return confirm('Are you sure you want to deactivate this user?')">Deactivate</a>


              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align:center;">No users found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <a href="dashboard.php" class="back-button">← Back to Dashboard</a>

  </div>

</body>

</html>

<?php $conn->close(); ?>
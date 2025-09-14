<?php
session_start();
$conn = new mysqli("localhost", "root", "", "vibescapedb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews with user name
$sql = "SELECT reviews.id, users.name, reviews.rating, reviews.comment, reviews.created_at
        FROM reviews
        JOIN users ON reviews.user_id = users.id
        ORDER BY reviews.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - User Reviews</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0d0d0d;
            color: #f5f5f5;
            padding: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #1a1a1a;
            color: #209b4dff;
        }
        tr:hover {
            background-color: rgba(255,255,255,0.05);
        }
        h2 {
            color: #169c47;
            margin-bottom: 20px;
        }
        .back-btn {
    display: inline-block;
    background-color: #169c47;
    color: #000;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 20px;
    transition: background 0.3s ease;
}
.back-btn:hover {
    background-color: #00cc6a;
}

    </style>
</head>
<body>

<h2>User Reviews</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>User</th>
        <th>Rating</th>
        <th>Comment</th>
        <th>Date</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= (int)$row['rating'] ?>/5</td>
        <td><?= htmlspecialchars($row['comment']) ?></td>
        <td><?= date('Y-m-d H:i', strtotime($row['created_at'])) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
<p>No reviews found.</p>
<?php endif; ?>


</body>
</html>

<?php
$conn->close();
?>

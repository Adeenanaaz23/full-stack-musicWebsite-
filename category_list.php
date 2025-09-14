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
  padding: 40px;
}

h2 {
  font-size: 28px;
  margin-bottom: 20px;
  color: var(--green);
}

.button {
  display: inline-block;
  background-color: var(--green);
  color: white;
  padding: 10px 20px;
  border-radius: var(--radius);
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: var(--green-dark);
}

table {
  width: 100%;
  margin-top: 25px;
  border-collapse: collapse;
  background: var(--bg-secondary);
  box-shadow: 0 4px 10px rgba(0,0,0,0.3);
  border: 1px solid var(--border-color);
}

th, td {
    background: #000;
  padding: 15px;
  border-bottom: 1px solid var(--border-color);
  text-align: left;
  font-size: 15px;
  color: var(--text-main);
}

th {
  background-color: var(--bg-secondary) !important;
  color: var(--text-main);
  border-bottom: 1px solid var(--border-color);
}


tr:hover {
  background-color: #1f1f1f;
}

td a {
  color: var(--green);
  text-decoration: none;
  margin-right: 12px;
  font-weight: 500;
}

td a:hover {
  text-decoration: underline;
}

</style>
<?php
include 'db.php'; // database connection

// Fetch categories from database
$sql = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
</head>
<body>

    <h2>Category List</h2>
    <a href="add_category.php" class="button">+ Add New Category</a>


    <table>
        <tr>
            <th>ID</th>
            <th>Category Title</th>
            <th>Actions</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>". $row['id'] ."</td>";
                echo "<td>". $row['title'] ."</td>";
                echo "<td>
                        <a href='edit_category.php?id=".$row['id']."'>Edit</a> |
                        <a href='delete_category.php?id=".$row['id']."' onclick=\"return confirm('Are you sure?')\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No categories found.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

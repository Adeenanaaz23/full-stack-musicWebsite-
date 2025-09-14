<?php
include 'db.php';

$message = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get current category title
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);

    if (!$category) {
        die("Category not found.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_title = mysqli_real_escape_string($conn, $_POST['title']);

        if (!empty($new_title)) {
            $update = "UPDATE categories SET title = '$new_title' WHERE id = $id";
            if (mysqli_query($conn, $update)) {
                $message = "Category updated successfully!";
                $category['title'] = $new_title; // Update title in variable
            } else {
                $message = "Error updating: " . mysqli_error($conn);
            }
        } else {
            $message = "Please enter a category title.";
        }
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
            color: #111;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 25px;
            color: #333;
        }

        form {
            background: #ffffff;
            padding: 30px;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            margin-bottom: 20px;
            background-color: #fafafa;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #555;
            background-color: #fff;
            outline: none;
        }

        input[type="submit"] {
            background-color: #111;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        .message {
            margin-top: 20px;
            color: green;
            font-weight: 500;
            font-size: 14px;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2>Edit Category</h2>
    <form method="POST" action="">
        <label>New Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($category['title']); ?>" required>
        <input type="submit" value="Update Category">
    </form>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <a href="category_list.php">← Back to Category List</a>

</body>
</html>

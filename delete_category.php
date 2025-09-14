<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $delete = "DELETE FROM categories WHERE id = $id";
    if (mysqli_query($conn, $delete)) {
        header("Location: category_list.php");
        exit();
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>

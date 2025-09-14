<?php
include '../backend/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $imagePath = $_POST['image_path'];
    $audioPath = $_POST['audio_path'];

    // Delete from DB
    $sql = "DELETE FROM songs WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Delete files from folder
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    if (file_exists($audioPath)) {
        unlink($audioPath);
    }

    echo "<script>alert('Song deleted successfully.'); window.location.href='music.php';</script>";
}
?>
 
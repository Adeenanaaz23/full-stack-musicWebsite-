<?php
include '../backend/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_song'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $category = $_POST['category'];

    $imageName = $_FILES['image']['name'];
    $audioName = $_FILES['audio']['name'];

    $imageTmp = $_FILES['image']['tmp_name'];
    $audioTmp = $_FILES['audio']['tmp_name'];

    // Define folders
    $imageFolder = '../uploads/images/';
    $audioFolder = '../uploads/audio/';

    // Create folders if they don't exist
    if (!is_dir($imageFolder)) mkdir($imageFolder, 0777, true);
    if (!is_dir($audioFolder)) mkdir($audioFolder, 0777, true);

    // Move uploaded files
    move_uploaded_file($imageTmp, $imageFolder . $imageName);
    move_uploaded_file($audioTmp, $audioFolder . $audioName);

    // Insert into database (only filenames)
    mysqli_query($conn, "INSERT INTO songs (title, artist, category, image, audio)
        VALUES ('$title', '$artist', '$category', '$imageName', '$audioName')");

    // Redirect after success
    header("Location: manage_songs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Song - VibeScape</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #121212;
      color: white;
      padding: 50px;
      font-family: 'Montserrat', sans-serif;
    }
    h2 {
      text-align: center;
      color: #1db954;
      margin-bottom: 30px;
    }
    .form-container {
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
    }
    label {
      margin-top: 10px;
    }
    input, select {
      width: 100%;
      margin-top: 5px;
      padding: 10px;
      background-color: #2c2c2c;
      border: 1px solid #444;
      color: white;
    }
    .btn-primary {
      background-color: #1db954;
      border: none;
      margin-top: 20px;
    }
    .btn-primary:hover {
      background-color: #17a34a;
    }
  </style>
</head>
<body>

<h2>Upload a New Song</h2>

<div class="form-container">
  <form method="POST" enctype="multipart/form-data">
    <label>Song Title:</label>
    <input type="text" name="title" required>

    <label>Artist:</label>
    <input type="text" name="artist" required>

    <label>Category:</label>
    <select name="category" required>
      <option value="Popular">Popular</option>
      <option value="People Also Like">People Also Like</option>
      <option value="Trending Rap">Trending Rap</option>
    </select>

    <label>Upload Image:</label>
    <input type="file" name="image" accept="image/*" required>

    <label>Upload Audio:</label>
    <input type="file" name="audio" accept="audio/*" required>

    <button type="submit" name="add_song" class="btn btn-primary">Add Song</button>
  </form>
</div>

</body>
</html>

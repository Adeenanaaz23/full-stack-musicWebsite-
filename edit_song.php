<?php
include '../backend/db.php';

$id = $_GET['id'];
$song = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM songs WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $category = $_POST['category'];

    // Optional image update
    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imagePath = '../uploads/images/' . $imageName;
        move_uploaded_file($imageTmp, $imagePath);
    } else {
        $imagePath = $song['image']; // Keep old image
    }

    // Optional audio update
    if (!empty($_FILES['audio']['name'])) {
        $audioName = $_FILES['audio']['name'];
        $audioTmp = $_FILES['audio']['tmp_name'];
        $audioPath = '../uploads/audio/' . $audioName;
        move_uploaded_file($audioTmp, $audioPath);
    } else {
        $audioPath = $song['audio']; // Keep old audio
    }

    mysqli_query($conn, "UPDATE songs SET 
        title = '$title', 
        artist = '$artist', 
        category = '$category', 
        image = '$imagePath', 
        audio = '$audioPath' 
        WHERE id = $id");

    header("Location: manage_songs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Song</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #121212;
      color: white;
      padding: 50px;
      font-family: 'Montserrat', sans-serif;
    }

    .form-container {
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
    }

    input, select {
      background-color: #2c2c2c;
      color: white;
      border: 1px solid #444;
      width: 100%;
      margin-top: 10px;
      padding: 10px;
    }

    .btn-primary {
      background-color: #1db954;
      border: none;
      margin-top: 15px;
    }

    .btn-primary:hover {
      background-color: #17a34a;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #1db954;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Song</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Song Title</label>
    <input type="text" name="title" value="<?= $song['title'] ?>" required>

    <label>Artist</label>
    <input type="text" name="artist" value="<?= $song['artist'] ?>" required>

    <label>Category</label>
    <select name="category" required>
      <option value="Popular" <?= $song['category'] == 'Popular' ? 'selected' : '' ?>>Popular</option>
      <option value="People Also Like" <?= $song['category'] == 'People Also Like' ? 'selected' : '' ?>>People Also Like</option>
      <option value="Trending Rap" <?= $song['category'] == 'Trending Rap' ? 'selected' : '' ?>>Trending Rap</option>
    </select>

    <label>Upload New Image (Optional)</label>
    <input type="file" name="image">
    <p>Current: <img src="<?= $song['image'] ?>" width="60"></p>

    <label>Upload New Audio (Optional)</label>
    <input type="file" name="audio">
    <p>Current Audio:
      <audio controls style="width: 120px;">
        <source src="<?= $song['audio'] ?>" type="audio/mpeg">
      </audio>
    </p>

    <button type="submit" class="btn btn-primary">Update Song</button>
  </form>
</div>

</body>
</html>

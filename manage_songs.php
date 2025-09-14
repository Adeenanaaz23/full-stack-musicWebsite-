<?php
include '../backend/db.php';

// Handle Song Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_song'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $category = $_POST['category'];

    $imageName = $_FILES['image']['name'];
    $audioName = $_FILES['audio']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $audioTmp = $_FILES['audio']['tmp_name'];
$imagePath = '../uploads/images/' . $imageName;
$audioPath = '../uploads/audio/' . $audioName;

if (!is_dir('../uploads/images')) mkdir('../uploads/images', 0777, true);
if (!is_dir('../uploads/audio')) mkdir('../uploads/audio', 0777, true);

move_uploaded_file($imageTmp, $imagePath);
move_uploaded_file($audioTmp, $audioPath);

// ✅ Only save file names in the DB!
mysqli_query($conn, "INSERT INTO songs (title, artist, category, image, audio) VALUES 
    ('$title', '$artist', '$category', '$imageName', '$audioName')");

    header("Location: manage_songs.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM songs WHERE id = $id");
    header("Location: manage_songs.php");
    exit;
}

// Fetch Songs
$songs = mysqli_query($conn, "SELECT * FROM songs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Songs - VibeScape</title>
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

    table {
      width: 100%;
      background-color: #1e1e1e;
      border-collapse: collapse;
      margin-bottom: 40px;
    }

    th, td {
      border-bottom: 1px solid #333;
      padding: 15px;
      text-align: center;
    }

    th {
      color: #1db954;
    }

    a {
      color: #1db954;
      text-decoration: none;
      margin: 0 5px;
    }

    a:hover {
      text-decoration: underline;
    }

    .form-container {
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
    }

    input, select {
      width: 100%;
      margin-top: 10px;
      padding: 10px;
      background-color: #2c2c2c;
      border: 1px solid #444;
      color: white;
    }

    .btn-primary {
      background-color: #1db954;
      border: none;
      margin-top: 15px;
    }

    .btn-primary:hover {
      background-color: #17a34a;
    }
  </style>
</head>
<body>

<h2>Song Management Panel</h2>

<!-- Upload Button -->
<div class="text-center mb-4">
  <a href="add_song.php" class="btn btn-primary">Upload New Song</a>
</div>

<!-- Songs Table -->
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Artist</th>
      <th>Category</th>
      <th>Image</th>
      <th>Audio</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($songs)): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['title'] ?></td>
      <td><?= $row['artist'] ?></td>
      <td><?= $row['category'] ?></td>
      <td><img src="../uploads/images/<?= $row['image'] ?>" width="50">
</td>
      <td>
        <audio controls style="width: 120px;">
    <source src="../uploads/audio/<?= $row['audio'] ?>" type="audio/mpeg">
    Your browser does not support the audio tag.
  </audio>
 

      </td>
      <td>
        <a href="edit_song.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this song?')">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>




</body>
</html>

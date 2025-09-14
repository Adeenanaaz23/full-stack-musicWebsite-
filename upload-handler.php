<?php
// DB connection
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'vibescapedb'; // change if different
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}

// Create folders if not exist
$audioDir = '../uploads/audio/';
$thumbDir = '../uploads/thumbnails/';
if (!is_dir($audioDir)) mkdir($audioDir, 0777, true);
if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);

// Get form data
$title = trim($_POST['title']);
$artist = trim($_POST['artist']);
$category = trim($_POST['category']);
$audio = $_FILES['audio'];
$thumbnail = $_FILES['thumbnail'] ?? null;

// Validate
if (empty($title) || empty($artist) || empty($category) || !$audio) {
  die("All fields are required.");
}

// Audio file
$audioName = time() . '_' . basename($audio['name']);
$audioPath = $audioDir . $audioName;
move_uploaded_file($audio['tmp_name'], $audioPath);

// Thumbnail file (optional)
$thumbnailPath = null;
if ($thumbnail && $thumbnail['error'] === 0) {
  $thumbName = time() . '_' . basename($thumbnail['name']);
  $thumbnailPath = $thumbDir . $thumbName;
  move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO sounds (title, artist, category, audio_path, thumbnail_path) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $title, $artist, $category, $audioName, $thumbName);
if ($stmt->execute()) {
  echo "<div class='success'>✅ Song uploaded successfully! <a href='../view/sound.php'>View All</a></div>";
} else {
  echo "<div class='error'>❌ Failed to upload song: " . $stmt->error . "</div>";
}

$stmt->close();
$conn->close();
?>

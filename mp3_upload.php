<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audioFile'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $file = $_FILES['audioFile'];

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($ext !== 'mp3') {
        die('Only MP3 files are allowed.');
    }

    // Generate new filename
    $newName = time() . '_' . preg_replace('/\W+/', '-', basename($file['name']));
    $uploadPath = '../uploads/audio/' . $newName;

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        die('Failed to upload file. Make sure uploads/audio folder exists and is writable.');
    }

    // ✅ Use MySQL instead of SQLite
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=vibescapedb;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO audios (title, filename, category) VALUES (?, ?, ?)");
        $stmt->execute([$title, $newName, $category]);

        echo "✅ Upload successful!";
    } catch (PDOException $e) {
        die("❌ Database error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload mp3</title>
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
    background-color: var(--bg-primary);
    font-family: 'Segoe UI', sans-serif;
    color: var(--text-main);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
  }

  form {
    background-color: var(--bg-secondary);
    border: 1px solid var(--border-color);
    padding: 24px;
    border-radius: var(--radius);
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: 320px;
  }

  input[type="text"],
  select,
  input[type="file"] {
    background-color: var(--bg-primary);
    color: var(--text-main);
    border: 1px solid var(--border-color);
    padding: 10px;
    border-radius: var(--radius);
    font-size: 14px;
    outline: none;
    transition: border 0.3s;
  }

  input[type="text"]:focus,
  select:focus,
  input[type="file"]:focus {
    border-color: var(--green);
  }

  button {
    background-color: var(--green);
    color: white;
    border: none;
    padding: 12px;
    border-radius: var(--radius);
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  button:hover {
    background-color: var(--green-dark);
  }
</style>

</head>
<body>
  
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Song Title" required />
    <select name="category">
      <option value="voice">Voice Note</option>
      <option value="song">Song</option>
    </select>
    <input type="file" name="audioFile" accept=".mp3" required />
    <button type="submit">Upload</button>
  </form>
</body>
</html>

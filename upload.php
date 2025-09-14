<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload New Sound</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: Arial, sans-serif;
      padding: 50px 20px;
    }

    .upload-container {
      max-width: 600px;
      margin: auto;
      background: #1e1e1e;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(37, 211, 102, 0.2);
    }

    h2 {
      text-align: center;
      color: #25D366;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      background-color: #2a2a2a;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 15px;
    }

    input[type="file"] {
      padding: 8px;
      background-color: #1f1f1f;
    }

    button {
      background-color: #25D366;
      color: white;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      margin-top: 20px;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #1ebd5b;
    }

    .success {
      color: #25D366;
      text-align: center;
      margin-top: 20px;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="upload-container">
  <h2>Upload New Song</h2>
  <form action="upload-handler.php" method="POST" enctype="multipart/form-data">
    
    <label for="title">Song Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="artist">Artist:</label>
    <input type="text" name="artist" id="artist" required>

    <label for="category">Category:</label>
    <select name="category" id="category" required>
      <option value="">-- Select Category --</option>
      <option value="Bollywood">Bollywood</option>
      <option value="Bollywood">Pakistani</option>
      <option value="Hollywood">Hollywood</option>
      <option value="Sad">Sad</option>
      <option value="Instrumental">Instrumental</option>
      <option value="Romantic">Romantic</option>
      <option value="Devotional">Devotional</option>
    </select>

    <label for="audio">Audio File (MP3):</label>
    <input type="file" name="audio" id="audio" accept="audio/*" required>

    <label for="thumbnail">Thumbnail Image (Optional):</label>
    <input type="file" name="thumbnail" id="thumbnail" accept="image/*">

    <button type="submit">Upload Song</button>
  </form>
</div>

</body>
</html>

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
  margin: 0;
  padding: 0;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.wrapper {
  width: 100%;
  max-width: 500px;
  padding: 20px;
}

form {
  background: var(--bg-secondary);
  padding: 30px;
  border-radius: var(--radius);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}

h2 {
  text-align: center;
  margin-bottom: 25px;
  color: var(--green);
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: 500;
}

input[type="text"],
input[type="submit"] {
  width: 100%;
  box-sizing: border-box; /* Ensures padding & border are inside width */
  padding: 12px 14px;
  font-size: 15px;
  border-radius: var(--radius);
  margin-bottom: 20px;
}
input[type="text"] {
  background: #222;
  color: var(--text-main);
  border: 1px solid var(--border-color);
}

input[type="submit"] {
  background-color: var(--green);
  color: white;
  border: none;
  cursor: pointer;
  transition: background 0.3s ease;
}


input[type="submit"]:hover {
  background-color: var(--green-dark);
}

.message {
  text-align: center;
  color: var(--green);
  font-size: 14px;
}

a {
  display: block;
  text-align: center;
  margin-top: 15px;
  color: var(--text-muted);
  text-decoration: none;
}

a:hover {
  color: var(--green);
}

    @media (max-width: 600px) {
    body {
        padding: 20px;
    }

    form {
       max-width: 500px;
  margin: 0 auto;
    }

    h2 {
        font-size: 22px;
        margin-bottom: 20px;
    }

    label {
        font-size: 14px;
        margin-bottom: 8px;
    }

    input[type="text"],
    input[type="submit"] {
        font-size: 14px;
        padding: 10px 12px;
    }

    input[type="submit"] {
        width: 100%;
    }
}

</style>
<?php
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);

    if (!empty($title)) {
        $sql = "INSERT INTO categories (title) VALUES ('$title')";
        if (mysqli_query($conn, $sql)) {
            $message = "Category added successfully!";
        } else {
            $message = "Error adding category: " . mysqli_error($conn);
        }
    } else {
        $message = "Please enter a category title.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input[type=text] { padding: 8px; width: 300px; }
        input[type=submit] { padding: 8px 15px; margin-top: 10px; }
        .message { margin-top: 15px; color: green; }
    </style>
</head>
<body>

<div class="min-h-screen bg-[#111111] text-white flex items-center justify-center px-4">
  <form class="bg-[#1b1b1b] p-8 rounded-lg shadow-lg w-full max-w-xl">
    <h2 class="text-2xl font-bold text-center text-[#1db954] mb-6">Edit Category</h2>

    <div class="mb-4">
      <label for="title" class="block mb-2 font-medium text-white">New Title:</label>
      <input
        type="text"
        id="title"
        name="title"
        class="block w-full p-3 rounded-md bg-[#222] text-white border border-[#2e2e2e] focus:outline-none focus:ring-2 focus:ring-[#1db954]"
        placeholder="Enter new title"
      />
    </div>

    <div>
      <input
        type="submit"
        value="Update Category"
        class="block w-full p-3 rounded-md bg-[#1db954] text-white font-semibold hover:bg-[#169c47] transition-colors duration-300"
      />
    </div>

    <p class="text-center text-[#1db954] text-sm mt-4">Your message here</p>
    <a href="dashboard.php" class="block text-center mt-3 text-[#999] hover:text-[#1db954] transition">← Back to Dashboard</a>
  </form>
</div>


</body>
</html>

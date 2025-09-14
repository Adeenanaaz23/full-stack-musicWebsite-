<?php
include '../backend/db.php';
// $conn = new mysqli("localhost", "root", "", "vibescapedb");
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// 



$songs = $conn->query("SELECT COUNT(*) AS total FROM songs")->fetch_assoc()['total'];
$users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$reviews = $conn->query("SELECT COUNT(*) AS total FROM reviews")->fetch_assoc()['total'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard – Vibescape</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>

    .dashboard {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-top: 20px;
}
.card {
  background-color: #1e1e1e;
  border-radius: 10px;
  padding: 40px;            
  width: 320px;             
  color: #ffffff;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: transform 0.2s ease;
}



.card:hover {
  transform: translateY(-5px);
}

.card p {
  font-size: 22px; 
}


   :root {
  --bg: #0d0d0d;          
  --sidebar: #121212;    
  --primary: #1db954;
  --card: #1e1e1e;        
  --text: #f5f5f5;       
  --subtext: #888;        
}

body.light {
  --bg: #f4f4f4;
  --sidebar: #ffffff;
   --primary: #28a745;
  --card: #ffffff;
  --text: #111;
  --subtext: #555;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: var(--bg);
  color: var(--text);
  transition: 0.3s ease;
  display: flex;
  min-height: 100vh;
}

.sidebar {
  width: 220px;
  background: var(--sidebar);
  padding: 2rem 1rem;
  display: flex;
  flex-direction: column;
}

.sidebar h2 {
  color: var(--primary);
  margin-bottom: 2rem;
  text-align: center;
}

.sidebar a {
  color: var(--text);
  text-decoration: none;
  margin: 1rem 0;
  display: block;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: 0.3s;
}

.sidebar a:hover {
  background: rgba(255, 255, 255, 0.08); 
  color: white; 
}


.main {
  flex: 1;
  padding: 2rem;
}

.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.topbar h1 {
  font-size: 1.5rem;
  color: var(--primary);
}

.toggle-btn {
  background: var(--primary);
  border: none;
  padding: 1rem 1.4rem;
  color: #fff;
  border-radius: 25px;
  cursor: pointer;
  font-weight: bold;
}

.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 2rem;
  margin-top: 2rem;
}



.card:hover {
  transform: translateY(-5px);
}

.card h3 {
  color: var(--primary);
  font-size: 1.7rem;
  margin-bottom: 0.8rem;
}



@media (max-width: 768px) {
  .sidebar {
    display: none;
  }
}

  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Vibescape</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_songs.php">Manage Music</a>
    <a href="manage_users.php">Users</a>
    <a href="review.php">Reviews</a>
    <a href="manage_subscriptions.php">Manage Plans</a>
    <a href="../backend/logout.php">Logout</a>
  </div>

  <div class="main">
    <div class="topbar">
      <h1>Admin Dashboard</h1>
      <button class="toggle-btn" onclick="toggleTheme()">Toggle Theme</button>
    </div>


  <div class="dashboard">
  <div class="card">
    <h3>Total Songs</h3>
    <p><?php echo $songs; ?> uploaded</p>
  </div>



  <div class="card">
    <h3>Registered Users</h3>
    <p><?php echo $users; ?> members</p>
  </div>

  <div class="card">
    <h3>Reviews</h3>
    <p><?php echo $reviews; ?></p>
  </div>
</div>

    </div>
  </div>



  <script>
    function toggleTheme() {
      document.body.classList.toggle("light");
    }
  </script>
</body>
</html>

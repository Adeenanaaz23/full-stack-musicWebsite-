<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Privacy Policy | VibeScape</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background-color: var(--bg-primary);
  color: var(--text-main);
  padding: 40px 20px;
}

.sitemap-wrapper {
  max-width: 900px;
  margin: auto;
  background-color: var(--bg-secondary);
  border: 1px solid var(--border-color);
  border-radius: var(--radius);
  padding: 40px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
}

.sitemap-heading {
  font-size: 32px;
  color: var(--green);
  margin-bottom: 10px;
}

.sitemap-subheading {
  font-size: 16px;
  color: var(--text-muted);
  margin-bottom: 30px;
}

.sitemap-section {
  margin-bottom: 30px;
}

.sitemap-category {
  font-size: 20px;
  color: var(--green);
  margin-bottom: 15px;
  border-bottom: 1px solid var(--border-color);
  padding-bottom: 5px;
}

.sitemap-list {
  list-style: none;
  padding-left: 0;
}

.sitemap-item {
  margin-bottom: 12px;
}

.sitemap-item a {
  color: var(--text-main);
  text-decoration: none;
  font-size: 16px;
  transition: color 0.3s ease;
}

.sitemap-item a:hover {
  color: var(--green-dark);
}

/* Responsive Design */
@media (max-width: 600px) {
  .sitemap-wrapper {
    padding: 25px;
  }

  .sitemap-heading {
    font-size: 26px;
  }

  .sitemap-category {
    font-size: 18px;
  }

  .sitemap-item a {
    font-size: 15px;
  }
}

    </style>
</head>
<body>
  <div class="sitemap-wrapper">
    <h1 class="sitemap-heading">VibeScape Site Map</h1>
    <p class="sitemap-subheading">Quick links to all important sections of our site</p>

    <div class="sitemap-section">
      <h2 class="sitemap-category">Main Pages</h2>
      <ul class="sitemap-list">
        <li class="sitemap-item"><a href="./home.php">Home</a></li>
        <li class="sitemap-item"><a href="./music.php">Music</a></li>
        <li class="sitemap-item"><a href="./all-artists.php">Artists</a></li>
        <li class="sitemap-item"><a href="./premium.php">Premium</a></li>
        <li class="sitemap-item"><a href="./review_form.php">Reviews</a></li>
      </ul>
    </div>

    <div class="sitemap-section">
      <h2 class="sitemap-category">User</h2>
      <ul class="sitemap-list">
        <li class="sitemap-item"><a href="signup.html">Sign Up</a></li>
        <li class="sitemap-item"><a href="login.html">Login</a></li>
        <li class="sitemap-item"><a href="edit-profile-view.php">Edit Profile</a></li>
      </ul>
    </div>

    <div class="sitemap-section">
      <h2 class="sitemap-category">Legal</h2>
      <ul class="sitemap-list">
        <li class="sitemap-item"><a href="privacy-policy.html">Privacy Policy</a></li>
        <li class="sitemap-item"><a href="terms.html">Terms & Conditions</a></li>
      </ul>
    </div>

    <div class="sitemap-section">
      <h2 class="sitemap-category">Support</h2>
      <ul class="sitemap-list">
        <li class="sitemap-item"><a href="contact.html">Contact Us</a></li>
        <li class="sitemap-item"><a href="faq.html">FAQ</a></li>
      </ul>
    </div>
  </div>
</body>
</html>

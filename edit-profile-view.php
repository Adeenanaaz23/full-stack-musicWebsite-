<?php
session_start();
// Check if both user_id and email are set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vibescapedb");

$email = $_SESSION['user_email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Profile - VibeScape</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="vs-profile-body">

  <div class="vs-edit-profile-container">
    <h2>Edit Your Profile</h2>

<form id="editProfileForm" action="../backend/update-profile.php" method="POST">
  <input type="text" name="name" placeholder="Enter your name" required>
  <input type="email" name="email" placeholder="Enter your email" required>
  <button type="submit">Update Profile</button>
</form>

  </div>
<script>
document.getElementById("editProfileForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch("../backend/update-profile.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "success") {
      alert("✅ Profile updated successfully!");
    } else {
      alert("❌ " + data);
    }
  });
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>

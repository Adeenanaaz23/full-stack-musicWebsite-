<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$plan = $_GET['plan'] ?? 'individual'; // default
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Subscribe to <?= htmlspecialchars($plan) ?> Plan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
body {
  font-family: 'Montserrat', sans-serif;
  background: #121212;
  color: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.subscribe-confirm {
  background: #1a1a1a;
  padding: 50px 40px;
  border-radius: 20px;
  text-align: center;
  max-width: 500px;
  border: 1px solid #2d2d2d;
  transition: all 0.3s ease;
}

.subscribe-confirm h1 {
  font-size: 30px;
  margin-bottom: 20px;
  color: #27ae60; /* deep emerald */
  font-weight: 700;
}

.subscribe-confirm p {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 30px;
  color: #bcbcbc;
}

.btn.green {
  background-color: #219653; /* rich green */
  color: #ffffff;
  padding: 14px 34px;
  border: none;
  font-size: 16px;
  font-weight: 600;
  border-radius: 35px;
  cursor: pointer;
  transition: all 0.3s ease;

}

.btn.green:hover {
  background-color: #2ecc71; /* hover: lighter green */
  transform: translateY(-2px) scale(1.03);
}

  </style>
</head>
<body>
  <section class="subscribe-confirm">
    <h1>You're subscribing to the <span style="text-transform: capitalize;"><?= htmlspecialchars($plan) ?></span> Plan</h1>
    <p>This will update your account to premium. Enjoy ad-free music, offline downloads, and high-quality sound!</p>
    <form action="../backend/subscribe_process.php" method="POST">
      <input type="hidden" name="plan" value="<?= htmlspecialchars($plan) ?>">
     <button type="submit" class="btn green">🎉 Confirm Subscription</button>
    </form>
  </section>
</body>
</html>

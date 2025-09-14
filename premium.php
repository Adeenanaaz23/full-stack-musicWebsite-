<?php
session_start();

// Check if user is logged in and fullName is set
$fullName = isset($_SESSION['fullName']) ? $_SESSION['fullName'] : null;
$initial = $fullName ? strtoupper($fullName[0]) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibe Scape - The Entertainment Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<?php

$fullName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$initial = $fullName ? strtoupper(substr($fullName, 0, 1)) : '';
?>
<nav class="navbar navbar-expand-md fixed-top bg-dark navbar-dark" id="mainNav">
  <div class="container-fluid px-3">

    <!-- Left: Logo -->
    <a class="navbar-brand" href="./home.php">VibeScape</a>

    <!-- Hamburger Button (Mobile) -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Center: Nav Links -->
    <div class="collapse navbar-collapse justify-content-center" id="navContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white" href="./home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./music.php">Sound</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./category.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./all-artists.php">Artists</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="./premium.php">Premium</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="review_form.php">Reviews</a></li>
      </ul>
    </div>

    <!-- Right: Avatar/Profile -->
    <div class="d-none d-md-flex align-items-center ms-3">
      <?php if ($fullName): ?>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle p-0 text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="profile-avatar"><?php echo $initial; ?></div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="edit-profile-view.php">Edit Profile</a></li>
            <li><a class="dropdown-item" href="../backend/logout.php">Log out</a></li>
          </ul>
        </div>
      <?php else: ?>
        <a class="nav-link text-white" href="signup.html">Sign up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<section class="premium-section">
  <div class="premium-left">
    <h1><span>Listen without limits.</span><br>Try 1 month of Premium Individual for Rs 0.</h1>
    <p>Only Rs 349/month after. Cancel anytime.</p>
    <div class="premium-buttons">
      <button class="btn pink">Get started</button>
      <a href="#viewPlan"><button class="btn black">View all plans</button></a>
    </div>
    <small>
      Rs 0 for 1 month, then Rs 349 per month after. Offer only available if you haven’t tried Premium before.
      <a href="#">Terms apply</a>.
    </small>
  </div>

  <div class="premium-right">
    <div class="tilted-grid">
      <img src="../images/phonk.jpg" alt="Tile 1" />
      <img src="../images/easyonfriday.jpg" alt="Tile 2" />
      <img src="../images/housewerk.jpg" alt="Tile 3" />
      <img src="../images/topontheinternet.jpg" alt="Tile 4" />
      <img src="../images/mylifeisamovie.jpg" alt="Tile 5" />
      <img src="../images/oldschool.jpg" alt="Tile 6" />
    </div>
  </div>
</section>

<section class="features">
  <h2>Why go Premium?</h2>
  <ul>
    <li>Ad-free music listening</li>
    <li>Download to listen offline</li>
    <li>Play songs in any order</li>
    <li>High audio quality</li>
  </ul>
</section>

<!-- 🔥 Dynamic Plans Section -->
<section id="viewPlan" class="plans">
<?php
  require '../backend/db.php';
  $result = $conn->query("SELECT * FROM premium_plans");

  while ($plan = $result->fetch_assoc()):
    $features = explode("\n", $plan['features']);
?>
 <div class="plan-card">
  <h2 class="<?= $plan['color_class'] ?>"><?= htmlspecialchars($plan['title']) ?></h2>
  <p><?= htmlspecialchars($plan['price']) ?></p>
  <ul>
    <?php foreach ($features as $feature): ?>
      <li><?= htmlspecialchars($feature) ?></li>
    <?php endforeach; ?>
  </ul>

  <form action="../backend/subscribe.php" method="POST">
    <input type="hidden" name="plan_title" value="<?= htmlspecialchars($plan['title']) ?>">
    <input type="hidden" name="plan_price" value="<?= htmlspecialchars($plan['price']) ?>">
    <button type="submit" class="btn <?= $plan['color_class'] ?>">
      <?= htmlspecialchars($plan['cta_text']) ?>
    </button>
  </form>
</div>

<?php endwhile; ?>
</section>
<?php if (isset($_GET['subscribed'])): ?>
<div class="alert alert-success text-center">
  🎉 You’re now subscribed to the <strong><?= htmlspecialchars($_GET['subscribed']) ?></strong> plan!
</div>
<?php endif; ?>


  <footer class="footer py-4">
        <div class="container footer-container text-center animate-element fade-in-up">
            <p>&copy; 2025 SOUND Group. All Rights Reserved.</p>
            <p class="footer-links-row">
                <a href="./privacy_policy.html" class="footer-link">Privacy Policy</a> |
                <a href="./sitemap.php" class="footer-link">Sitemap</a>
            </p>
        </div>
    </footer>


  <script>
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const item = header.parentElement;
        item.classList.toggle('active');
      });
    });
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
  AOS.init();
</script>
</body>
</html>
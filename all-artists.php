<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibe Scape - The Entertainment Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
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
 <div class="section-wrapper__artists" >
    <h1 style="margin-top: 100px;" class="section-heading__artists-title">All Artists</h1>

    <div class="grid-layout__artist-list">
      <div class="card-component__artist-item">
        <a href="artist_profile_page.php?name=Pritam">
  
        <img src="../images/pritam_artist.jpeg" alt="Pritam" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Pritam</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>
      <div class="card-component__artist-item">
        <a href="AtifAslam.php?name=AtifAslam">
  
        <img src="../images/atif_aslam.jpg" alt="Afusic" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Atif Aslam</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>
      <div class="card-component__artist-item">
        <a href="Shubh.php?name=Shubh">
  
        <img src="../images/anuv_jain.jpg" alt="Atif Aslam" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Anuv jain</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>
      <div class="card-component__artist-item">
         <a href="AsimAzhar.php?name=AsimAzhar">
        <img src="../images/asim_azhar.jpg" alt="Shubh" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Asim Azhar</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>

      <div class="card-component__artist-item">
          <a href="youngStunner.php?name=youngstunner">
        <img src="../images/young_stunners.jpg" alt="Young Stunners" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Young Stunners</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>
      <div class="card-component__artist-item">
          <a href="Bayan.php?name=Bayan">
        <img src="../images/bayan.jpeg" alt="Bayaan" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Bayaan</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>
      <div class="card-component__artist-item">
          <a href="AUR.php?name=AUR">
        <img src="../images/AUR.jpg" alt="AUR" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">AUR</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>
      <div class="card-component__artist-item">
          <a href="Abdul_hannan.php?name=AbdulHannan">
        <img src="../images/abdul_hannan.jpg" alt="Abdul Hannan" class="card-image__artist-photo" />
        <div class="card-content__artist-info">
          <div class="text-style__artist-name">Abdul Hannan</div>
          <div class="text-style__artist-role">Artist</div>
        </div>
      </a>
      </div>

      <!-- Add more artists here -->
    </div>
  </div>
    <footer class="footer py-4">
        <div class="container footer-container text-center animate-element fade-in-up">
            <p>&copy; 2025 SOUND Group. All Rights Reserved.</p>
            <p class="footer-links-row">
                <a href="./privacy_policy.html" class="footer-link">Privacy Policy</a> |
                <a href="./sitemap.php" class="footer-link">Sitemap</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script>
  const slider = document.querySelector(".artist-slider");
  const leftBtn = document.querySelector(".slider-btn.left");
  const rightBtn = document.querySelector(".slider-btn.right");

  leftBtn.addEventListener("click", () => {
    slider.scrollBy({ left: -300, behavior: "smooth" });
  });

  rightBtn.addEventListener("click", () => {
    slider.scrollBy({ left: 300, behavior: "smooth" });
  });
</script>
</body>
</html>

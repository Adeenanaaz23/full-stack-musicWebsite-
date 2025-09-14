<?php
include '../backend/db.php';

session_start();

$result = mysqli_query($conn, "SELECT * FROM songs WHERE category = 'Popular'");

$result2 = mysqli_query($conn, "SELECT * FROM songs WHERE category = 'People Also Like'");

$result1 = mysqli_query($conn, "SELECT * FROM songs WHERE category = 'Trending Rap'");

?>



<style>
.music-card {
    background: #121212;
    color: white;
    padding: 30px;
    border-radius: 30px;
    width: 360px;
    height: 560px;
    margin: 30px;
    text-align: center;
    position: relative;
    box-shadow: 0 0 10px rgba(0,0,0,0.4);
    display: flex;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
    flex-shrink: 0;
}

.card-image-container {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    width: 100%;
    height: 300px;
    margin-bottom: 10px;
    flex-shrink: 0;
}

.card-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.play-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background-color: #1DB954;
    border: none;
    border-radius: 50%;
    padding: 10px;
    cursor: pointer;
    transition: background 0.3s ease;
    z-index: 2;
}

.play-btn span {
    font-size: 18px;
    color: white;
}

.play-btn:hover {
    background-color: #1ed760;
}

audio {
    display: none;
}

.card-info {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.card-info h4 {
    font-size: 16px;
    font-weight: 700;
    margin: 8px 0 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-info p {
    font-size: 13px;
    color: #ccc;
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.delete-btn {
    background: #e63946;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 10px;
    font-size: 13px;
}

.trending-slider {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 0;
}

.trending-slider::-webkit-scrollbar {
    display: none;
}

.slider-btn {
    background: none;
    border: none;
    color: white;
    font-size: 28px;
    cursor: pointer;
    padding: 0 10px;
    z-index: 5;
} 

</style> 
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
<!--search-->

    <div class="d-flex align-items-center position-relative me-3">
  <input type="text" id="searchInput" placeholder="Search songs or category..." class="form-control bg-dark text-white border-0 px-3 py-2 rounded-pill" style="width: 300px;" autocomplete="off">
</div>

<!-- SEARCH RESULT CARDS WILL APPEAR HERE -->
<div id="searchResults"></div>


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
<section class="music-section" style="margin-top: 150px;">
  <div class="section-header">
    <h1>Popular trendings</h1>
  </div>
  <div class="trending-slider-wrapper">
    <button class="slider-btn left">&#10094;</button>
    <div class="trending-slider">
     <?php while($row = mysqli_fetch_assoc($result)): ?>
 
      <div class="music-card"
     data-title="<?= strtolower($row['title']) ?>"
     data-artist="<?= strtolower($row['artist']) ?>"
     data-category="<?= strtolower($row['category']) ?>">

    <div class="card-image-container">
      <img src="../uploads/images/<?php echo $row['image']; ?>" alt="Song Image">
        <button class="play-btn" onclick="togglePlay(this)">
            <span style="font-size: 20px; color: white;"> ▶</span>
        </button>
        <audio src="../uploads/audio/<?php echo $row['audio']; ?>"></audio>
    </div>
    <div class="card-info">
        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
        <p><?php echo htmlspecialchars($row['artist']); ?> (<?php echo htmlspecialchars($row['category']); ?>)</p>

    </div>
</div>

<?php endwhile; ?>

    </div>
    <button class="slider-btn right">&#10095;</button>
  </div>
</section>


<section class="music-section" style="margin-top: 150px;">
  <div class="section-header">
    <h1>People Also Like</h1>
  </div>
  <div class="trending-slider-wrapper">
    <button class="slider-btn left">&#10094;</button>
    <div class="trending-slider">
     <?php while($row = mysqli_fetch_assoc($result2)): ?>

<div class="music-card"
     data-title="<?= strtolower($row['title']) ?>"
     data-artist="<?= strtolower($row['artist']) ?>"
     data-category="<?= strtolower($row['category']) ?>">
    <div class="card-image-container">
        <img src="../uploads/images/<?php echo $row['image']; ?>" alt="Song Image">
        <button class="play-btn" onclick="togglePlay(this)">
            <span style="font-size: 20px; color: white;"> ▶</span>
        </button>
       <audio src="../uploads/audio/<?php echo $row['audio']; ?>"></audio>
    </div>
    <div class="card-info">
        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
        <p><?php echo htmlspecialchars($row['artist']); ?> (<?php echo htmlspecialchars($row['category']); ?>)</p>

    </div>
</div>

<?php endwhile; ?>

    </div>
    <button class="slider-btn right">&#10095;</button>
  </div>
</section>


<section class="music-section" style="margin-top: 150px;">
  <div class="section-header">
    <h1> Trending Rap</h1>
  </div>
  <div class="trending-slider-wrapper">
    <button class="slider-btn left">&#10094;</button>
    <div class="trending-slider">
     <?php while($row = mysqli_fetch_assoc($result1)): ?>
  
    <div class="music-card"
     data-title="<?= strtolower($row['title']) ?>"
     data-artist="<?= strtolower($row['artist']) ?>"
     data-category="<?= strtolower($row['category']) ?>">
    <div class="card-image-container">
        <img src="../uploads/images/<?php echo $row['image']; ?>" alt="Song Image">
        <button class="play-btn" onclick="togglePlay(this)">
            <span style="font-size: 20px; color: white;"> ▶</span>
        </button>
        <audio src="../uploads/audio/<?php echo $row['audio']; ?>"></audio>
    </div>
    <div class="card-info">
        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
        <p><?php echo htmlspecialchars($row['artist']); ?> (<?php echo htmlspecialchars($row['category']); ?>)</p>

    </div>
</div>
<?php endwhile; ?>

    </div>
    <button class="slider-btn right">&#10095;</button>
  </div>
</section>

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
  document.querySelectorAll(".popular-trendings").forEach(section => {
    const slider = section.querySelector(".trending-slider");
    const leftBtn = section.querySelector(".slider-btn.left");
    const rightBtn = section.querySelector(".slider-btn.right");

    leftBtn.addEventListener("click", () => {
      slider.scrollBy({ left: -300, behavior: "smooth" });
    });

    rightBtn.addEventListener("click", () => {
      slider.scrollBy({ left: 300, behavior: "smooth" });
    });
  });
</script>
<script>
document.querySelectorAll(".music-section").forEach(section => {
  const slider = section.querySelector(".trending-slider");
  const leftBtn = section.querySelector(".slider-btn.left");
  const rightBtn = section.querySelector(".slider-btn.right");

  if (slider && leftBtn && rightBtn) {
    leftBtn.addEventListener("click", () => {
      slider.scrollBy({ left: -300, behavior: "smooth" });
    });

    rightBtn.addEventListener("click", () => {
      slider.scrollBy({ left: 300, behavior: "smooth" });
    });
  }
});

</script>
<script>
function togglePlay(button) {
    const card = button.closest('.music-card');
    const audio = card.querySelector('audio');

    // Pause all other audio players
    document.querySelectorAll('audio').forEach(function(player) {
        if (player !== audio) {
            player.pause();
            player.currentTime = 0;
        }
    });

    // Toggle play/pause on the current audio
    if (audio.paused) {
        audio.play();
        button.innerHTML = '<span style="font-size: 20px; color: white;">⏸</span>';
    } else {
        audio.pause();
        button.innerHTML = '<span style="font-size: 20px; color: white;">▶</span>';
    }

    // Reset button when audio ends
    audio.onended = function() {
        button.innerHTML = '<span style="font-size: 20px; color: white;">▶</span>';
    };
}

document.getElementById('searchInput').addEventListener('input', function () {
  const query = this.value.toLowerCase().trim();
  const cards = document.querySelectorAll('.music-card');

  cards.forEach(card => {
    const title = card.getAttribute('data-title');
    const artist = card.getAttribute('data-artist');
    const category = card.getAttribute('data-category');

    if (title.includes(query) || artist.includes(query) || category.includes(query)) {
      card.style.display = 'flex'; // or 'inline-block', based on layout
    } else {
      card.style.display = 'none';
    }
  });
});





</script>

</body>
</html>   



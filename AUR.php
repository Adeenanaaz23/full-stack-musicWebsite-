<?php
session_start();
?>

<style>
  .custom-play-button {
  font-size: 30px;
  color: #1DB954;
  cursor: pointer;
  margin-right: 20px;
  transition: transform 0.2s ease;
}
.custom-play-button:hover {
  transform: scale(1.2);
}
.custom-play-button i {
  pointer-events: none;
}</style>

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
  <!-- Main section -->
<div class="artist-banner__container" style="background: url('../images/AUR.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; margin-top:53px;">
    <div></div>
    <div class="artist-banner__overlay" >
      <p class="artist-banner__verified">✔ Verified Artist</p>
      <h1 class="artist-banner__name">AUR</h1>
      <p class="artist-banner__listeners">11,900,80 monthly listeners</p>
      <div class="artist-banner__actions">
       <button id="masterPlayButton" class="artist-button__play">▶ Play</button>

        <button class="artist-button__follow">Follow</button>
      </div>
    </div>
  </div>

  <div class="artist-songs__section">
    <h2 class="artist-songs__heading">Popular</h2>
<ol class="artist-songs__list">

  <!-- Song 1 -->
  <li class="artist-songs__item">
    <img src="../images/kya chahiyai.jpg" alt="kya chahiyai" class="artist-songs__cover">
    <div class="artist-songs__info">
      <p class="artist-songs__title">Kya chahiyai</p>
      <p class="artist-songs__plays">7,321,01 plays</p>
    </div>
    <div style="display: flex; align-items: center;">
      <div class="custom-play-button" onclick="playSong('audio1', this)">
        <i class="fas fa-play-circle"></i>
      </div>
      <a href="../AUDIO/AUR - KYA CHAHIYE - Usama - Ahad - Raffey  (Official Music Video).mp3" download style="margin-left: 8px; color: #000;">
        <i class="fas fa-download custom-download-button"></i>
      </a>
    </div>
    <audio id="audio1" src="../AUDIO/AUR - KYA CHAHIYE - Usama - Ahad - Raffey  (Official Music Video).mp3"></audio>
  </li>

  <!-- Song 2 -->
  <li class="artist-songs__item">
    <img src="../images/dooriyan.jpg" alt="dooriyan" class="artist-songs__cover">
    <div class="artist-songs__info">
      <p class="artist-songs__title">Dooriyan</p>
      <p class="artist-songs__plays">2,602,00 plays</p>
    </div>
    <div style="display: flex; align-items: center;">
      <div class="custom-play-button" onclick="playSong('audio2', this)">
        <i class="fas fa-play-circle"></i>
      </div>
      <a href="../AUDIO/AUR - DOORIYAAN - Raffey - Ahad - Usama (Official Audio).mp3" download style="margin-left: 8px; color: #000;">
        <i class="fas fa-download custom-download-button"></i>
      </a>
    </div>
    <audio id="audio2" src="../AUDIO/AUR - DOORIYAAN - Raffey - Ahad - Usama (Official Audio).mp3"></audio>
  </li>

  <!-- Song 3 -->
  <li class="artist-songs__item">
    <img src="../images/chal diyai tum kahan pe.jpg" alt="Chal diyai tum kahan pe" class="artist-songs__cover">
    <div class="artist-songs__info">
      <p class="artist-songs__title">Chal diyai tum kahan pe</p>
      <p class="artist-songs__plays">570,950 plays</p>
    </div>
    <div style="display: flex; align-items: center;">
      <div class="custom-play-button" onclick="playSong('audio3', this)">
        <i class="fas fa-play-circle"></i>
      </div>
      <a href="../AUDIO/CHAL DIYE TUM KAHAN  AUDIO   AUR  AHAD KHAN &  USAMA ALI  RAFFEY ANWAR  KABHI MAIN KABHI TUM.mp3" download style="margin-left: 8px; color: #000;">
        <i class="fas fa-download custom-download-button"></i>
      </a>
    </div>
    <audio id="audio3" src="../AUDIO/CHAL DIYE TUM KAHAN  AUDIO   AUR  AHAD KHAN &  USAMA ALI  RAFFEY ANWAR  KABHI MAIN KABHI TUM.mp3"></audio>
  </li>

  <!-- Song 4 -->
  <li class="artist-songs__item">
    <img src="../images/shikayat.jfif" alt="shikayat" class="artist-songs__cover">
    <div class="artist-songs__info">
      <p class="artist-songs__title">Shikayat</p>
      <p class="artist-songs__plays">1,402,32 plays</p>
    </div>
    <div style="display: flex; align-items: center;">
      <div class="custom-play-button" onclick="playSong('audio4', this)">
        <i class="fas fa-play-circle"></i>
      </div>
      <a href="../AUDIO/AUR - SHIKAYAT - Raffey - Usama - Ahad (Official Music Video).mp3" download style="margin-left: 8px; color: #000;">
        <i class="fas fa-download custom-download-button"></i>
      </a>
    </div>
    <audio id="audio4" src="../AUDIO/AUR - SHIKAYAT - Raffey - Usama - Ahad (Official Music Video).mp3"></audio>
  </li>

  <!-- Song 5 -->
  <li class="artist-songs__item">
    <img src="../images/tu hai kahan.jpeg" alt="tu hai kahan" class="artist-songs__cover">
    <div class="artist-songs__info">
      <p class="artist-songs__title">Tu hai kahan</p>
      <p class="artist-songs__plays">812,133,940 plays</p>
    </div>
    <div style="display: flex; align-items: center;">
      <div class="custom-play-button" onclick="playSong('audio5', this)">
        <i class="fas fa-play-circle"></i>
      </div>
      <a href="../AUDIO/Tu Hai Kahan by AUR  تو ہے کہاں (Official Music Video).mp3" download style="margin-left: 8px; color: #000;">
        <i class="fas fa-download custom-download-button"></i>
      </a>
    </div>
    <audio id="audio5" src="../AUDIO/Tu Hai Kahan by AUR  تو ہے کہاں (Official Music Video).mp3"></audio>
  </li>

</ol>


  <!-- Add more songs in same structure -->

      <!-- More songs can be added here -->
    </ol>
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
  let currentAudio = null;

  function playSong(audioId, button) {
    const audio = document.getElementById(audioId);

    // Pause currently playing audio if it's not the same
    if (currentAudio && currentAudio !== audio) {
      currentAudio.pause();
      currentAudio.currentTime = 0;
    }

    if (audio.paused) {
      audio.play();
      currentAudio = audio;
      button.innerHTML = '<i class="fas fa-pause-circle"></i>';
    } else {
      audio.pause();
      button.innerHTML = '<i class="fas fa-play-circle"></i>';
    }

    // Reset icon when audio ends
    audio.onended = () => {
      button.innerHTML = '<i class="fas fa-play-circle"></i>';
    };
  }
</script>
<script>
  const audioElements = Array.from(document.querySelectorAll('audio'));
  let currentIndex = 0;
  let isPlaying = false;

  document.getElementById('masterPlayButton').addEventListener('click', function () {
    if (!isPlaying) {
      currentIndex = 0;
      playNextAudio();
      this.textContent = '⏸ Pause';
    } else {
      pauseAllAudios();
      this.textContent = '▶ Play';
    }

    isPlaying = !isPlaying;
  });

  function playNextAudio() {
    if (currentIndex >= audioElements.length) {
      isPlaying = false;
      document.getElementById('masterPlayButton').textContent = '▶ Play';
      return;
    }

    const currentAudio = audioElements[currentIndex];

    // Play the current audio
    currentAudio.play();

    // When current audio ends, play next
    currentAudio.onended = function () {
      currentIndex++;
      playNextAudio();
    };

    // Pause others
    audioElements.forEach((audio, i) => {
      if (i !== currentIndex) {
        audio.pause();
        audio.currentTime = 0;
      }
    });
  }

  function pauseAllAudios() {
    audioElements.forEach(audio => {
      audio.pause();
    });
  }
</script>

<script>
  AOS.init();
</script>
</body>
</html>
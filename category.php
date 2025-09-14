<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.html?unauthorized=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vibe Scape - The Entertainment Hub</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
      body {
        background: #121212;
        font-family: Arial, sans-serif;
        padding: 40px;
        color: #fff;
      }

      .filter-tabs {
        display: flex;
        justify-content: center;
        margin-top: 60px;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
      }
      .tab {
        padding: 10px 20px;
        background-color: #333;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 20px;
        transition: background 0.3s;
      }
      .tab.active,
      .tab:hover {
        background-color: #25d366;
      }

      .section-title {
        text-align: center;
        font-size: 20px;
        margin: 40px auto 20px;
        border-bottom: 1px solid #333;
        width: fit-content;
        padding-bottom: 5px;
      }

      h2 {
        text-align: center;
        margin-bottom: 30px;
        margin-top: 112px;
      }

      .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        max-width: 800px;
        margin: 40px;
      }

      .voice-note {
        background-color: #1e1e1e;
        padding: 14px 18px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 0 10px rgba(37, 211, 102, 0.2);
      }

      .play-btn {
        background-color: #25d366;
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 18px;
        width: 40px;
        height: 40px;
        cursor: pointer;
      }

      .waveform {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex: 1;
        height: 28px;
        gap: 2px;
        padding: 0 4px;
      }

      .bar {
        width: 3px;
        background-color: #25d366;
        border-radius: 2px;
        animation: wave 1s infinite ease-in-out;
        animation-play-state: paused;
        height: 12px;
      }

      .bar:nth-child(2) {
        animation-delay: 0.1s;
      }
      .bar:nth-child(3) {
        animation-delay: 0.2s;
      }
      .bar:nth-child(4) {
        animation-delay: 0.3s;
      }
      .bar:nth-child(5) {
        animation-delay: 0.4s;
      }
      .bar:nth-child(6) {
        animation-delay: 0.5s;
      }

      @keyframes wave {
        0%,
        100% {
          height: 10px;
        }
        50% {
          height: 28px;
        }
      }

      .time {
        color: #ccc;
        font-size: 12px;
        min-width: 35px;
        text-align: right;
      }

      .audio-section {
        display: none;
        animation: fadeIn 0.3s ease;
      }

      .audio-section.active {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .voice-note {
        display: flex;
        align-items: center;
        gap: 14px;
      }

      .thumbnail {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        margin-bottom: 5px;
        margin-top: 10px;
      }
      .download-btn {
        margin-top: 8px;
        padding: 6px 12px;
        background-color: #25d366;
        color: #fff;
        border-radius: 8px;
        font-size: 13px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s;
      }
      .download-btn:hover {
        background-color: #1ebd5b;
      }
      .audio-section {
        padding: 20px;
      }

      .grid-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
      }

      .voice-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 200px;
      }

      .voice-title {
        margin-top: 10px;
        text-align: center;
        font-size: 1rem;
        color: #333;
      }
      .voice-note {
        display: flex;
        align-items: center;
        gap: 14px;
      }

      .thumb-title-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 60px;
      }

      .song-title {
        font-size: 13px;
        color: #fff;
        margin-bottom: 4px;
        text-align: center;
        line-height: 1.1;
      }

      .thumbnail {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
      }
    </style>
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

      <input type="text" id="searchInput" placeholder="Search anything..." style="padding: 10px; width: 300px;">
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
    <h2>Sound & Music Collection</h2>
    <h3 style="text-align: center;">By Years</h3>

<!-- Year filter group -->
<div class="tab-group" data-type="year">
  <div class="filter-tabs">
    <button class="tab active" data-filter="2025">2025</button>
    <button class="tab" data-filter="2024" class="searchable">2024</button>
    <button class="tab" data-filter="2023" class="searchable">2023</button>
    <button class="tab" data-filter="2022" class="searchable">2022</button>
    <button class="tab" data-filter="2021" class="searchable">2021</button>
    <button class="tab" data-filter="90's" class="searchable">90's</button>
  </div>
</div>
    <!-- 2025 Songs -->
    <div class="audio-section active year-2025" data-category="2025">
      <!-- Song 1 -->
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/saiyara.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Saiyara</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Saiyaara Title Song  Ahaan Panday, Aneet Padda  Tanishk Bagchi, Faheem A, Arslan N  Irshad Kamil.mp3"
          ></audio>
          <a
            href="../AUDIO/Saiyaara Title Song  Ahaan Panday, Aneet Padda  Tanishk Bagchi, Faheem A, Arslan N  Irshad Kamil.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 2 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/jaane tu.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Jaane tu</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Jaane Tu  Chhaava  Vicky K, Rashmika M  A. R. Rahman, Arijit Singh, Irshad Kamil  Song Out Now.mp3"
          ></audio>
          <a
            href="../AUDIO/Jaane Tu  Chhaava  Vicky K, Rashmika M  A. R. Rahman, Arijit Singh, Irshad Kamil  Song Out Now.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 3 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/kanimaa.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Kanimaa</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Full Video_ KANIMAA - RETRO  Suriya  Karthik Subbaraj  Pooja Hegde  Santhosh Narayanan.mp3"
          ></audio>
          <a
            href="../AUDIO/Full Video_ KANIMAA - RETRO  Suriya  Karthik Subbaraj  Pooja Hegde  Santhosh Narayanan.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>

      <!-- Song 5 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/pal pal.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Pal Pal</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/Pal Pal - (Raag.Fm).mp3"></audio>
          <a
            href="../AUDIO/Pal Pal - (Raag.Fm).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>



      <!-- Song 6 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/afsos.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Afsos</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Anuv Jain - AFSOS ft. AP Dhillon (Official Visualizer).mp3"
          ></audio>
          <a
            href="../AUDIO/Anuv Jain - AFSOS ft. AP Dhillon (Official Visualizer).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 7 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/haseen.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Haseen</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/HASEEN - TALWIINDER, NDS, RIPPY (Official Visualizer).mp3"
          ></audio>
          <a
            href="../AUDIO/HASEEN - TALWIINDER, NDS, RIPPY (Official Visualizer).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 8 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/departure_lane.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Haseen</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Talha Anjum - Departure Lane  Prod. by Umair (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Talha Anjum - Departure Lane  Prod. by Umair (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 8 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/maand....jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Haseen</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Bayaan  Hasan Raheem  Rovalio - Maand (Lyric Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Bayaan  Hasan Raheem  Rovalio - Maand (Lyric Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
    </div>
      </div>
    <!-- 2024 Songs -->

    <div class="audio-section" data-category="2024">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/kashish.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Kashish</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/KASHISH.mp3"></audio>
          <a href="../AUDIO/KASHISH.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/chuttmalle.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Chuttmalle</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Chuttamalle.mp3"></audio>
          <a href="../AUDIO/Chuttamalle.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/raanjhan.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Raanjhan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Do Patti_ Raanjhan (Full Video) Kriti Sanon, Shaheer Sheikh  Parampara Tandon  Sachet-Parampara.mp3"
          ></audio>
          <a
            href="../AUDIO/Do Patti_ Raanjhan (Full Video) Kriti Sanon, Shaheer Sheikh  Parampara Tandon  Sachet-Parampara.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/tauba tauba.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tauba tauba</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Tauba Tauba.mp3"></audio>
          <a href="../AUDIO/Tauba Tauba.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/asa kooda.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Aasa koda</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Aasa Kooda.mp3"></audio>
          <a href="../AUDIO/Aasa Kooda.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/ishq.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Ishq</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Ishq.mp3"></audio>
          <a href="../AUDIO/Ishq.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
    </div>
      </div>
    <!-- 2023 Songs -->
    <div class="audio-section" data-category="2023">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/tere vaste.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tere Vaste</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Tere Vaaste - lyrics  Zara Hatke Zara Bachke.mp3"
          ></audio>
          <a
            href="../AUDIO/Tere Vaaste - lyrics  Zara Hatke Zara Bachke.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 2 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Satranga.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Satranga</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/ANIMAL_ SATRANGA(Song) Ranbir Kapoor,RashmikaSandeep VArijit,Shreyas P,Siddharth-Garima Bhushan K.mp3"
          ></audio>
          <a
            href="../AUDIO/ANIMAL_ SATRANGA(Song) Ranbir Kapoor,RashmikaSandeep VArijit,Shreyas P,Siddharth-Garima Bhushan K.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 3-->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Tum Kya Mie.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tum kya mile</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Tum Kya Mile - Rocky Aur Rani Kii Prem Kahaani  Ranveer  Alia  Pritam  Amitabh  Arijit  Shreya.mp3"
          ></audio>
          <a
            href="../AUDIO/Tum Kya Mile - Rocky Aur Rani Kii Prem Kahaani  Ranveer  Alia  Pritam  Amitabh  Arijit  Shreya.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 4 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/phir aur kya chahiyai.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Phir aur kya chahiyai</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Phir Aur Kya Chahiye (Lyrics) - Arijit Singh.mp3"
          ></audio>
          <a
            href="../AUDIO/Phir Aur Kya Chahiye (Lyrics) - Arijit Singh.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 5 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/chaleya.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Chaleya</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/JAWAN_ Chaleya (Hindi)  Shah Rukh Khan  Nayanthara  Atlee  Anirudh  Arijit S, Shilpa R  Kumaar.mp3"
          ></audio>
          <a
            href="../AUDIO/JAWAN_ Chaleya (Hindi)  Shah Rukh Khan  Nayanthara  Atlee  Anirudh  Arijit S, Shilpa R  Kumaar.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 6 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/what jhumka.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">What jhumka</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/what jhumka.mp3"></audio>
          <a href="../AUDIO/what jhumka.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
    </div>
      </div>
    <!-- 2022 Songs -->

    <div class="audio-section" data-category="2022">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/pasori.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Pasori</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Pasoori  Ali Sethi, Shae Gill  Coke Studio  Lyrics.mp3"
          ></audio>
          <a
            href="../AUDIO/Pasoori  Ali Sethi, Shae Gill  Coke Studio  Lyrics.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Excuses.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Excuses</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Excuses (Official Video)  AP Dhillon  Gurinder Gill  Intense.mp3"
          ></audio>
          <a
            href="../AUDIO/Excuses (Official Video)  AP Dhillon  Gurinder Gill  Intense.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div></div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Maan Meri Jaan.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Maan meri jan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/King - Maan Meri Jaan (Lyrics).mp3"></audio>
          <a
            href="../AUDIO/King - Maan Meri Jaan (Lyrics).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Tumse Bhi Zyada.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tumse bh zyada</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Tumse Bhi Zyada - Full Video  Tadap  Ahan Shetty, Tara Sutaria  Pritam, Arijit Singh.mp3"
          ></audio>
          <a
            href="../AUDIO/Tumse Bhi Zyada - Full Video  Tadap  Ahan Shetty, Tara Sutaria  Pritam, Arijit Singh.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Apna Bana Le.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Apna bana le</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Apna Bana Le - Full Audio  Bhediya  Varun Dhawan, Kriti Sanon Sachin-Jigar,Arijit Singh,Amitabh B.mp3"
          ></audio>
          <a
            href="../AUDIO/Apna Bana Le - Full Audio  Bhediya  Varun Dhawan, Kriti Sanon Sachin-Jigar,Arijit Singh,Amitabh B.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/kesariya original.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Kesariya</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Kesariya (Lyrics) Full Song - Brahmastra  Arijit Singh  Kesariya Tera Ishq Hai Piya.mp3"
          ></audio>
          <a
            href="../AUDIO/Kesariya (Lyrics) Full Song - Brahmastra  Arijit Singh  Kesariya Tera Ishq Hai Piya.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/iraday.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Iraaday</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Abdul Hannan & Rovalio - Iraaday (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Abdul Hannan & Rovalio - Iraaday (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
    </div>

    <!-- 2021 Songs -->

    <div class="audio-section" data-category="2021">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/laga reh.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Laga reh</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/LAGA REH - Young Stunners  Talha Anjum  Talhah Yunus  Prod. Jokhay (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/LAGA REH - Young Stunners  Talha Anjum  Talhah Yunus  Prod. Jokhay (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/whynotmeri jan.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Why not meri jan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Why Not Meri Jaan (PenduJatt.Com.Se).mp3"
          ></audio>
          <a
            href="../AUDIO/Why Not Meri Jaan (PenduJatt.Com.Se).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/rafta rafta.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Rafta</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Rafta Rafta - Official Music Video  Raj Ranjodh  Atif Aslam Ft. Sajal Ali  Tarish Music.mp3"
          ></audio>
          <a
            href="../AUDIO/Rafta Rafta - Official Music Video  Raj Ranjodh  Atif Aslam Ft. Sajal Ali  Tarish Music.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Lut Gaye.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Lut gaye</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Lut Gaye (Lyrical) Emraan Hashmi, Yukti  Jubin N, Tanishk B, Manoj M  Bhushan K  Radhika-Vinay.mp3"
          ></audio>
          <a
            href="../AUDIO/Lut Gaye (Lyrical) Emraan Hashmi, Yukti  Jubin N, Tanishk B, Manoj M  Bhushan K  Radhika-Vinay.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Ranjha.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Ranjha</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Ranjha  Official Video  Shershaah  SidharthKiara  B Praak  Jasleen Royal  Romy  Anvita Dutt.mp3"
          ></audio>
          <a
            href="../AUDIO/Ranjha  Official Video  Shershaah  SidharthKiara  B Praak  Jasleen Royal  Romy  Anvita Dutt.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Raataan Lambiyan.jpeg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Raatan Lambiyan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Ranjha  Official Video  Shershaah  SidharthKiara  B Praak  Jasleen Royal  Romy  Anvita Dutt.mp3"
          ></audio>
          <a
            href="../AUDIO/Ranjha  Official Video  Shershaah  SidharthKiara  B Praak  Jasleen Royal  Romy  Anvita Dutt.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
    </div>
        <div class="audio-section" data-category="2022">
          <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/pasori.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Pasori</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Pasoori  Ali Sethi, Shae Gill  Coke Studio  Lyrics.mp3"
          ></audio>
          <a
            href="../AUDIO/Pasoori  Ali Sethi, Shae Gill  Coke Studio  Lyrics.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Excuses.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Excuses</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Excuses (Official Video)  AP Dhillon  Gurinder Gill  Intense.mp3"
          ></audio>
          <a
            href="../AUDIO/Excuses (Official Video)  AP Dhillon  Gurinder Gill  Intense.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Maan Meri Jaan.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Maan meri jan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/King - Maan Meri Jaan (Lyrics).mp3"></audio>
          <a
            href="../AUDIO/King - Maan Meri Jaan (Lyrics).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Tumse Bhi Zyada.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tumse bh zyada</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Tumse Bhi Zyada - Full Video  Tadap  Ahan Shetty, Tara Sutaria  Pritam, Arijit Singh.mp3"
          ></audio>
          <a
            href="../AUDIO/Tumse Bhi Zyada - Full Video  Tadap  Ahan Shetty, Tara Sutaria  Pritam, Arijit Singh.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Apna Bana Le.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Apna bana le</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Apna Bana Le - Full Audio  Bhediya  Varun Dhawan, Kriti Sanon Sachin-Jigar,Arijit Singh,Amitabh B.mp3"
          ></audio>
          <a
            href="../AUDIO/Apna Bana Le - Full Audio  Bhediya  Varun Dhawan, Kriti Sanon Sachin-Jigar,Arijit Singh,Amitabh B.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/kesariya original.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Kesariya</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Kesariya (Lyrics) Full Song - Brahmastra  Arijit Singh  Kesariya Tera Ishq Hai Piya.mp3"
          ></audio>
          <a
            href="../AUDIO/Kesariya (Lyrics) Full Song - Brahmastra  Arijit Singh  Kesariya Tera Ishq Hai Piya.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/iraday.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Iraaday</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Abdul Hannan & Rovalio - Iraaday (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Abdul Hannan & Rovalio - Iraaday (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
    </div>
      </div>
    <!-- 90's Songs -->

    <div class="audio-section" data-category="90's">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img
              src="../images/kiska hai ye tumko intezar.jpg"
              class="thumbnail"
            />
            <h3 class="song-title" class="searchable">Kiska hai ye tumko intezar</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Main Hoon Na Title Song Full Video  Main Hoon Na  Shahrukh Khan, Zayed Khan.mp3"
          ></audio>
          <a
            href="../AUDIO/Main Hoon Na Title Song Full Video  Main Hoon Na  Shahrukh Khan, Zayed Khan.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img
              src="../images/itna na mujhse tu pyar badha.jpg"
              class="thumbnail"
            />
            <h3 class="song-title" class="searchable">Itna na mujhse</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Itna Na Mujhse Tu Pyaar Badha  Lata Mangeshkar, Talat Mahmood  Bollywood Classic Hit Song  Chhaya.mp3"
          ></audio>
          <a
            href="../AUDIO/Itna Na Mujhse Tu Pyaar Badha  Lata Mangeshkar, Talat Mahmood  Bollywood Classic Hit Song  Chhaya.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/abhi na jao chhod kar.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Abhi na jao chod kr</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Abhi Na Jaao Chhod Kar  Dev Anand  Sadhana  Mohd Rafi  Asha Bhosle  Hum Dono (1961).mp3"
          ></audio>
          <a
            href="../AUDIO/Abhi Na Jaao Chhod Kar  Dev Anand  Sadhana  Mohd Rafi  Asha Bhosle  Hum Dono (1961).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/chunnari chunnari.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Chunnari chunnari</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Chunnari Chunnari  Biwi No.1  Salman Khan  Sushmita Sen  Abhijeet Bhattacharya  Anuradha Sriram.mp3"
          ></audio>
          <a
            href="../AUDIO/Chunnari Chunnari  Biwi No.1  Salman Khan  Sushmita Sen  Abhijeet Bhattacharya  Anuradha Sriram.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img
              src="../images/aankhein khuli ho ya band.jpg"
              class="thumbnail"
            />
            <h3 class="song-title" class="searchable">Ankhein khuli ho ya band</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/AANKHEIN KHULI HO YA HO BAND-(lyrics)  MOHABBATEIN  SRK #song #music #bollywood #lyrics.mp3"
          ></audio>
          <a
            href="../AUDIO/AANKHEIN KHULI HO YA HO BAND-(lyrics)  MOHABBATEIN  SRK #song #music #bollywood #lyrics.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/jadu teri nazar.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Jadu teri nazar</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Jaadu Teri Nazar Song  Darr  Shah Rukh Khan, Juhi Chawla  Udit Narayan  Shiv-Hari  Anand Bakshi.mp3"
          ></audio>
          <a
            href="../AUDIO/Jaadu Teri Nazar Song  Darr  Shah Rukh Khan, Juhi Chawla  Udit Narayan  Shiv-Hari  Anand Bakshi.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/dekha ek khwaab.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Dekha ek khuwab</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Dekha Ek Khwab Song  Silsila  Amitabh Bachchan, Rekha  Kishore Kumar, Lata Mangeshkar, Shiv-Hari.mp3"
          ></audio>
          <a
            href="../AUDIO/Dekha Ek Khwab Song  Silsila  Amitabh Bachchan, Rekha  Kishore Kumar, Lata Mangeshkar, Shiv-Hari.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
    </div>
  
    <h3 style="text-align: center;">By Languages</h3>
<div class="tab-group"  data-type="language">
    <div class="filter-tabs">
      <button class="tab active" data-filter="urdu">Urdu</button>
      <button class="tab" data-filter="hindi">Hindi</button>
      <button class="tab" data-filter="punjabi">Punjabi</button>
      <button class="tab" data-filter="english">English</button>
      <button class="tab" data-filter="arabic">Arabic</button>
</div>
    </div>
    <!-- urdu Songs -->
    <div class="audio-section active language-urdu" data-category="urdu">
      <!-- Song 1 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/maand....jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Maand</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Bayaan  Hasan Raheem  Rovalio - Maand (Lyric Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Bayaan  Hasan Raheem  Rovalio - Maand (Lyric Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 2 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/jhool.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Jhool</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Maanu, Annural Khalid - Jhol (Visualizer).mp3"
          ></audio>
          <a
            href="../AUDIO/Maanu, Annural Khalid - Jhol (Visualizer).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/chal diyai tum kahan pe.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Chal diyai tum</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/CHAL DIYE TUM KAHAN  AUDIO   AUR  AHAD KHAN &  USAMA ALI  RAFFEY ANWAR  KABHI MAIN KABHI TUM.mp3"
          ></audio>
          <a
            href="../AUDIO/CHAL DIYE TUM KAHAN  AUDIO   AUR  AHAD KHAN &  USAMA ALI  RAFFEY ANWAR  KABHI MAIN KABHI TUM.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
            <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/iraday.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Iraaday</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Abdul Hannan & Rovalio - Iraaday (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Abdul Hannan & Rovalio - Iraaday (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 3 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/pal pal.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Pal pal</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Pal Pal - (Raag.Fm).mp3"
          ></audio>
          <a
            href="../AUDIO/Pal Pal - (Raag.Fm).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 5 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/tu hai kahan.jpeg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tu hai kahan</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/Tu Hai Kahan by AUR  تو ہے کہاں (Official Music Video).mp3"></audio>
          <a
            href="../AUDIO/Tu Hai Kahan by AUR  تو ہے کہاں (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 6 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/rafta rafta.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Rafta Rafta</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Rafta Rafta - Official Music Video  Raj Ranjodh  Atif Aslam Ft. Sajal Ali  Tarish Music.mp3"
          ></audio>
          <a
            href="../AUDIO/Rafta Rafta - Official Music Video  Raj Ranjodh  Atif Aslam Ft. Sajal Ali  Tarish Music.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <!-- Song 7 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/haseen.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Haseen</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/HASEEN - TALWIINDER, NDS, RIPPY (Official Visualizer).mp3"
          ></audio>
          <a
            href="../AUDIO/HASEEN - TALWIINDER, NDS, RIPPY (Official Visualizer).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 8 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/departure_lane.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Departure Lane</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Talha Anjum - Departure Lane  Prod. by Umair (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Talha Anjum - Departure Lane  Prod. by Umair (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 8 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Pasoori.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Pasoori</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Pasoori  Ali Sethi, Shae Gill  Coke Studio  Lyrics.mp3"
          ></audio>
          <a
            href="../AUDIO/Pasoori  Ali Sethi, Shae Gill  Coke Studio  Lyrics.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
    </div>

    <!-- hindi Songs -->

    <div class="audio-section" data-category="hindi">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/kashish.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Kashish</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/KASHISH.mp3"></audio>
          <a href="../AUDIO/KASHISH.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/chuttmalle.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Chuttmalle</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Chuttamalle.mp3"></audio>
          <a href="../AUDIO/Chuttamalle.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/raanjhan.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Raanjhan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Do Patti_ Raanjhan (Full Video) Kriti Sanon, Shaheer Sheikh  Parampara Tandon  Sachet-Parampara.mp3"
          ></audio>
          <a
            href="../AUDIO/Do Patti_ Raanjhan (Full Video) Kriti Sanon, Shaheer Sheikh  Parampara Tandon  Sachet-Parampara.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/tauba tauba.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Tauba tauba</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Tauba Tauba.mp3"></audio>
          <a href="../AUDIO/Tauba Tauba.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/asa kooda.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Aasa koda</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Aasa Kooda.mp3"></audio>
          <a href="../AUDIO/Aasa Kooda.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/ishq.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Ishq</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Ishq.mp3"></audio>
          <a href="../AUDIO/Ishq.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
    </div>
      </div>

    <!-- punjabi Songs -->
    <div class="audio-section" data-category="punjabi">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Excuses.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Excuses</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Excuses (Official Video)  AP Dhillon  Gurinder Gill  Intense.mp3"
          ></audio>
          <a
            href="../AUDIO/Excuses (Official Video)  AP Dhillon  Gurinder Gill  Intense.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>

      <!-- Song 2 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/one love.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">One Love</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Shubh - One Love (Official Audio).mp3"
          ></audio>
          <a
            href="../AUDIO/Shubh - One Love (Official Audio).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 3-->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/cheque.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Cheque</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Shubh - Cheques (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Shubh - Cheques (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <!-- Song 4 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/baller.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Baller</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Baller - Shubh.mp3"
          ></audio>
          <a
            href="../AUDIO/Baller - Shubh.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 5 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/afsos.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Afsos</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Anuv Jain - AFSOS ft. AP Dhillon (Official Visualizer).mp3"
          ></audio>
          <a
            href="../AUDIO/Anuv Jain - AFSOS ft. AP Dhillon (Official Visualizer).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <!-- Song 6 -->
       <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/obsessed.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Obssesed</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/Obsessed - Riar Saab, @AbhijaySharma _ Official Music Video.mp3"></audio>
          <a href="../AUDIO/Obsessed - Riar Saab, @AbhijaySharma _ Official Music Video.mp3" download class="download-btn">⬇</a>
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/haseen.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Haseen</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/HASEEN - TALWIINDER, NDS, RIPPY (Official Visualizer).mp3"
          ></audio>
          <a
            href="../AUDIO/HASEEN - TALWIINDER, NDS, RIPPY (Official Visualizer).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/millionaire.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Millionaire</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/MILLIONAIRE SONG (Full Video)_ @YoYoHoneySingh  _ GLORY _ BHUSHAN KUMAR.mp3"
          ></audio>
          <a
            href="../AUDIO/MILLIONAIRE SONG (Full Video)_ @YoYoHoneySingh  _ GLORY _ BHUSHAN KUMAR.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/no love.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">No love</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/No Love - Shubh.mp3"
          ></audio>
          <a
            href="../AUDIO/No Love - Shubh.mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
    </div>

    <!-- english Songs -->

    <div class="audio-section" data-category="english">
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/die with a smile.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Die with smile</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Lady Gaga, Bruno Mars - Die With A Smile (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Lady Gaga, Bruno Mars - Die With A Smile (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/believer.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Believer</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Imagine Dragons - Believer (Lyrics).mp3"
          ></audio>
          <a
            href="../AUDIO/Imagine Dragons - Believer (Lyrics).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/blue.jpeg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Blue</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/yung kai - blue (official music video).mp3"></audio>
          <a
            href="../AUDIO/yung kai - blue (official music video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/i think they call this love.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">I think</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/I Think They Call This Love (Cover).mp3"
          ></audio>
          <a
            href="../AUDIO/I Think They Call This Love (Cover).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
<div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/i wanna be yours.jpeg" class="thumbnail" />
            <h3 class="song-title" class="searchable">Wanne be yours</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/I Wanna Be Yours.mp3"
          ></audio>
          <a
            href="../AUDIO/I Wanna Be Yours.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      </div>
      <div class="song-card">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/end of beginning.jpg" class="thumbnail" />
            <h3 class="song-title" class="searchable">End of beginning</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Djo - End Of Beginning (Official Audio).mp3"
          ></audio>
          <a
            href="../AUDIO/Djo - End Of Beginning (Official Audio).mp3"
            download
            class="download-btn"
            >⬇</a
          >
      </div>
        </div>
      </div>
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/line without a hook.jpg" class="thumbnail" />
            <h3 class="song-title">Line with a hook</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Ricky Montgomery - Line Without a Hook (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Ricky Montgomery - Line Without a Hook (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
       <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/co2.jpg" class="thumbnail" />
            <h3 class="song-title">CO2</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Prateek Kuhad - Co2 (Official Audio).mp3"
          ></audio>
          <a
            href="../AUDIO/Prateek Kuhad - Co2 (Official Audio).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/sweater weather.jpg" class="thumbnail" />
            <h3 class="song-title">Sweater weather</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/The Neighbourhood - Sweater Weather (Official Video).mp3"
          ></audio>
          <a
            href="../AUDIO/The Neighbourhood - Sweater Weather (Official Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/skyfall.jpg" class="thumbnail" />
            <h3 class="song-title">Skyfall</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Adele - Skyfall (Official Lyric Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Adele - Skyfall (Official Lyric Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
    </div>

    <!-- arabic Songs -->

    <div class="audio-section" data-category="arabic">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/kalam eineh.jpg" class="thumbnail" />
            <h3 class="song-title">Kalam eineh</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Sherine - Kalam Eineh _ شيرين - كلام عينيه.mp3"
          ></audio>
          <a
            href="../AUDIO/Sherine - Kalam Eineh _ شيرين - كلام عينيه.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/batmana ansak.webp" class="thumbnail" />
            <h3 class="song-title">Batmana ansak</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Batmana Ansak.mp3"
          ></audio>
          <a
            href="../AUDIO/Batmana Ansak.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/qusad einy.jpg" class="thumbnail" />
            <h3 class="song-title">Qusad einy</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Amr Diab - Qusad Einy _ عمرو دياب - قصاد عيني.mp3"
          ></audio>
          <a
            href="../AUDIO/Amr Diab - Qusad Einy _ عمرو دياب - قصاد عيني.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/skyfall.jpg" class="thumbnail" />
            <h3 class="song-title">Skyfall</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Lut Gaye (Lyrical) Emraan Hashmi, Yukti  Jubin N, Tanishk B, Manoj M  Bhushan K  Radhika-Vinay.mp3"
          ></audio>
          <a
            href="../AUDIO/Lut Gaye (Lyrical) Emraan Hashmi, Yukti  Jubin N, Tanishk B, Manoj M  Bhushan K  Radhika-Vinay.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/sabry aalil.jpg" class="thumbnail" />
            <h3 class="song-title">Sabry aalil</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Sherine - Sabry Aalil (Music Video)  (شيرين - صبري قليل (فيديو كليب.mp3"
          ></audio>
          <a
            href="../AUDIO/Sherine - Sabry Aalil (Music Video)  (شيرين - صبري قليل (فيديو كليب.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/callin u.jpg" class="thumbnail" />
            <h3 class="song-title">Callin u</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Elyanna - Callin' u (Tamally Maak)(Lyrics)(English Translation).mp3"
          ></audio>
          <a
            href="../AUDIO/Elyanna - Callin' u (Tamally Maak)(Lyrics)(English Translation).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/hayat şaşırtır.jpg" class="thumbnail" />
            <h3 class="song-title">Hayat şaşırtır</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Aydilge - Hayat Şaşırtır (Lyrics).mp3"
          ></audio>
          <a
            href="../AUDIO/Aydilge - Hayat Şaşırtır (Lyrics).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
    </div>
    <h3 style="text-align: center;">By Genre</h3>

    <div class="filter-tabs">
      <button class="tab active" data-filter="rock">Rock</button>
      <button class="tab" data-filter="hiphop">Hip/Hop - Rap</button>
      <button class="tab" data-filter="pop">Pop</button>
      <button class="tab" data-filter="jazz">Jazz</button>
  

    </div>

    <!-- rock Songs -->
    <div class="audio-section active genre-rock" data-category="rock">
      <!-- Song 1 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Bohemian Rhapsody.jpg" class="thumbnail" />
            <h3 class="song-title">Bohemian Rhapsody</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Queen – Bohemian Rhapsody (Official Video Remastered).mp3"
          ></audio>
          <a
            href="../AUDIO/Queen – Bohemian Rhapsody (Official Video Remastered).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 2 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Smells Like Teen Spirit.jpg" class="thumbnail" />
            <h3 class="song-title">Smells Like</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Nirvana - Smells Like Teen Spirit (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Nirvana - Smells Like Teen Spirit (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Back in Black.jpg" class="thumbnail" />
            <h3 class="song-title">Back in Black</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/AC_DC - Back In Black (Official 4K Video).mp3"
          ></audio>
          <a
            href="../AUDIO/AC_DC - Back In Black (Official 4K Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
            <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/stairway to heaven.jpg" class="thumbnail" />
            <h3 class="song-title">Stairway to heaven</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Nirvana - Smells Like Teen Spirit (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Nirvana - Smells Like Teen Spirit (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 3 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Paint It, Black.jpg" class="thumbnail" />
            <h3 class="song-title">Paint in black</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/The Rolling Stones - Paint It, Black (Official Lyric Video).mp3"
          ></audio>
          <a
            href="../AUDIO/The Rolling Stones - Paint It, Black (Official Lyric Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <!-- Song 5 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/The Beatles - Come Together.jpg" class="thumbnail" />
            <h3 class="song-title">Come Together</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/The Beatles - Come Together.mp3"></audio>
          <a
            href="../AUDIO/The Beatles - Come Together.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 6 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Red Hot Chili Peppers – Californication.jpg" class="thumbnail" />
            <h3 class="song-title">Californication</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Red Hot Chili Peppers - Californication (Official Music Video) [HD UPGRADE].mp3"
          ></audio>
          <a
            href="../AUDIO/Red Hot Chili Peppers - Californication (Official Music Video) [HD UPGRADE].mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 7 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Foo Fighters – Everlong.jpg" class="thumbnail" />
            <h3 class="song-title">Everlong</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Foo Fighters - Everlong (Official HD Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Foo Fighters - Everlong (Official HD Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
    </div>

    <!-- hiphop Songs -->

    <div class="audio-section" data-category="hiphop">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/The Notorious B.I.G. – Juicy.jpg" class="thumbnail" />
            <h3 class="song-title">Juicy</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/The Notorious B.I.G. - Juicy (Official Video) [4K] (1).mp3"></audio>
          <a href="../AUDIO/The Notorious B.I.G. - Juicy (Official Video) [4K] (1).mp3" download class="download-btn">⬇</a>
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Tupac – California Love.jpg" class="thumbnail" />
            <h3 class="song-title">California Love</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/2Pac - California Love (Lyrics) ft. Dr. Dre.mp3"></audio>
          <a href="../AUDIO/2Pac - California Love (Lyrics) ft. Dr. Dre.mp3" download class="download-btn">⬇</a>
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Kendrick Lamar – HUMBLE..jpg" class="thumbnail" />
            <h3 class="song-title">HUMBLE</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Kendrick Lamar - HUMBLE. (1).mp3"
          ></audio>
          <a
            href="../AUDIO/Kendrick Lamar - HUMBLE. (1).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Drake – God’s Plan.jpg" class="thumbnail" />
            <h3 class="song-title">God’s Plan</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Tauba Tauba.mp3"></audio>
          <a href="../AUDIO/Tauba Tauba.mp3" download class="download-btn">⬇</a>
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Jay-Z – 99 Problems.jpg" class="thumbnail" />
            <h3 class="song-title">99 Problems</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/JAY-Z - 99 Problems.mp3"></audio>
          <a href="../AUDIO/JAY-Z - 99 Problems.mp3" download class="download-btn">⬇</a>
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Nicki Minaj – Super Bass.jpg" class="thumbnail" />
            <h3 class="song-title">Super Bass</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Nicki Minaj - Super Bass (Official Video).mp3"></audio>
          <a href="../AUDIO/Nicki Minaj - Super Bass (Official Video).mp3" download class="download-btn">⬇</a>
        </div>
      </div>
    </div>

    <!-- pop Songs -->
    <div class="audio-section" data-category="pop">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Michael Jackson – Billie Jean.jpg" class="thumbnail" />
            <h3 class="song-title">Billie Jean</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Michael Jackson - Billie Jean (Official Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Michael Jackson - Billie Jean (Official Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <!-- Song 2 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Taylor Swift – Shake It Off.jpg" class="thumbnail" />
            <h3 class="song-title">Shake It Off</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Shake It Off - Taylor Swift (Lyrics) .mp3"
          ></audio>
          <a
            href="../AUDIO/Shake It Off - Taylor Swift (Lyrics) .mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 3-->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Dua Lipa – Levitating.jpg" class="thumbnail" />
            <h3 class="song-title">Levitating</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Dua Lipa - Levitating (Lyrics).mp3"
          ></audio>
          <a
            href="../AUDIO/Dua Lipa - Levitating (Lyrics).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 4 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/firework.jpg" class="thumbnail" />
            <h3 class="song-title">Firework</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Katy Perry - Firework (Official Music Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Katy Perry - Firework (Official Music Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 5 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/shape of you.jpg" class="thumbnail" />
            <h3 class="song-title">Shape of You</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio
            src="../AUDIO/Ed Sheeran - Shape of You (Lyrics).mp3"
          ></audio>
          <a
            href="../AUDIO/Ed Sheeran - Shape of You (Lyrics).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <!-- Song 6 -->
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Justin Bieber – Sorry.jpg" class="thumbnail" />
            <h3 class="song-title">Sorry</h3>
          </div>
          <button class="play-btn">▶</button>

          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>

          <audio src="../AUDIO/Justin Bieber - Sorry (Lyric Video).mp3"></audio>
          <a href="../AUDIO/Justin Bieber - Sorry (Lyric Video).mp3" download class="download-btn">⬇</a>
        </div>
      </div>
 
    </div>

    <!-- jazz Songs -->

    <div class="audio-section" data-category="jazz">
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Miles Davis – So What.jpg" class="thumbnail" />
            <h3 class="song-title">So What</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Miles Davis - So What (Official Audio).mp3"
          ></audio>
          <a
            href="../AUDIO/Miles Davis - So What (Official Audio).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Ella Fitzgerald – Summertime.jpg" class="thumbnail" />
            <h3 class="song-title">Summertime</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Louis Armstrong, Ella Fitzgerald - Summertime (Audio).mp3"
          ></audio>
          <a
            href="../AUDIO/Louis Armstrong, Ella Fitzgerald - Summertime (Audio).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Dave Brubeck – Take Five.jpg" class="thumbnail" />
            <h3 class="song-title">Take Five</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio src="../AUDIO/Dave Brubeck - Take Five.mp3"></audio>
          <a
            href="../AUDIO/Dave Brubeck - Take Five.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Nina Simone – Feeling Good.jpg" class="thumbnail" />
            <h3 class="song-title">Feeling Good</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Nina Simone - Feeling Good (Official Video).mp3"
          ></audio>
          <a
            href="../AUDIO/Nina Simone - Feeling Good (Official Video).mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>

      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/strange fruit.jpg" class="thumbnail" />
            <h3 class="song-title">Strange Fruit</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Billie Holiday-Strange fruit- HD.mp3"
          ></audio>
          <a
            href="../AUDIO/Billie Holiday-Strange fruit- HD.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
      </div>
      <div class="grid">
        <div class="voice-note">
          <div class="thumb-title-wrapper">
            <img src="../images/Herbie Hancock – Cantaloupe Island.jpg" class="thumbnail" />
            <h3 class="song-title">Cantaloupe Island</h3>
          </div>
          <button class="play-btn">▶</button>
          <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="time">0:00</div>
          <audio
            src="../AUDIO/Herbie Hancock - Cantaloupe Island.mp3"
          ></audio>
          <a
            href="../AUDIO/Herbie Hancock - Cantaloupe Island.mp3"
            download
            class="download-btn"
            >⬇</a
          >
        </div>
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
    <!-- Filter Tabs Script -->
    <script>
      const players = document.querySelectorAll(".voice-note");

      players.forEach((player) => {
        const btn = player.querySelector(".play-btn");
        const audio = player.querySelector("audio");
        const waveform = player.querySelector(".waveform");
        const bars = player.querySelectorAll(".bar");
        const time = player.querySelector(".time");

        btn.addEventListener("click", () => {
          // Pause all other audios
          players.forEach((p) => {
            const otherAudio = p.querySelector("audio");
            const otherBtn = p.querySelector(".play-btn");
            const otherWave = p.querySelector(".waveform");
            const otherBars = p.querySelectorAll(".bar");

            if (otherAudio !== audio) {
              otherAudio.pause();
              otherAudio.currentTime = 0;
              otherBtn.textContent = "▶";
              otherWave.classList.remove("active");

              // Pause bar animation for others
              otherBars.forEach(
                (bar) => (bar.style.animationPlayState = "paused")
              );
            }
          });

          // Play or Pause current
          if (audio.paused) {
            audio.play();
            btn.textContent = "⏸";
            waveform.classList.add("active");

            // Start wave animation
            bars.forEach((bar) => (bar.style.animationPlayState = "running"));
          } else {
            audio.pause();
            btn.textContent = "▶";
            waveform.classList.remove("active");

            // Stop wave animation
            bars.forEach((bar) => (bar.style.animationPlayState = "paused"));
          }
        });

        // Update time display
        audio.addEventListener("timeupdate", () => {
          const minutes = Math.floor(audio.currentTime / 60);
          const seconds = Math.floor(audio.currentTime % 60)
            .toString()
            .padStart(2, "0");
          time.textContent = `${minutes}:${seconds}`;
        });

        // On end, reset everything
        audio.addEventListener("ended", () => {
          btn.textContent = "▶";
          waveform.classList.remove("active");
          bars.forEach((bar) => (bar.style.animationPlayState = "paused"));
        });
      });
      const tabs = document.querySelectorAll(".tab");
      const sections = document.querySelectorAll(".audio-section");

      tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
          tabs.forEach((t) => t.classList.remove("active"));
          tab.classList.add("active");

          const target = tab.getAttribute("data-filter");
          sections.forEach((section) => {
            section.classList.toggle(
              "active",
              section.getAttribute("data-category") === target
            );
          });
        });
      });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const searchTerm = this.value.toLowerCase();
    const items = document.querySelectorAll('.song-card');

    items.forEach(item => {
        const text = item.innerText.toLowerCase();

        if (text.includes(searchTerm) && searchTerm !== "") {
            item.style.display = "block";

            // highlight matching word
            item.querySelectorAll('.searchable').forEach(el => {
                const content = el.textContent;
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                el.innerHTML = content.replace(regex, `<mark>$1</mark>`);
            });

        } else if (searchTerm === "") {
            item.style.display = "block";
            item.querySelectorAll('.searchable').forEach(el => {
                el.innerHTML = el.textContent; // reset highlight
            });
        } else {
            item.style.display = "none";
        }
    });
});
</script>
  </body>
</html>

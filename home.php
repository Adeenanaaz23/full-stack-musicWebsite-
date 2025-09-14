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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibe Scape - The Entertainment Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
.latest-music-section {
  margin-top:60px;
  padding: 60px 40px;
  background: #111;
  color: white;
  position: relative; 
  z-index: 1;          
}

.section-title {
  font-size: 2rem;
  text-align: center;
  margin-bottom: 30px;
  color: #00ff88;
}

.music-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 45px;
  justify-items: center;
}

.music-card {
  background: #222;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
  transition: transform 0.3s ease;
  width: 100%;
  max-width: 330px;
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 0.6s ease forwards;
  animation-delay: calc(var(--card-index) * 0.1s);
}

.music-card:hover {
  transform: translateY(-5px);
}

.music-card img {
  width: 100%;
  height: 170px;
  object-fit: cover;
}

.card-info {
  padding: 14px 12px;
  text-align: center;
}

.card-info h5 {
  margin-bottom: 4px;
  font-size: 1rem;
  color: #00ffc3;
}

.card-info p {
  font-size: 0.85rem;
  color: #ccc;
  margin-bottom: 10px;
}

.play-btn {
  background: linear-gradient(to right, #00c853, #64dd17);
  border: none;
  padding: 8px 16px;
  border-radius: 50px;
  font-size: 1.1rem;
  color: white;
  cursor: pointer;
  transition: 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.play-btn:hover {
  background: linear-gradient(to right, #64dd17, #00c853);
  transform: scale(1.05);
}

.play-btn .icon {
  color: white;
  font-size: 1.2rem;
}

/* Animation */
@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Grid */
@media (max-width: 992px) {
  .music-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .music-grid {
    grid-template-columns: 1fr;
  }
}
.latest-video-section {
  padding: 60px 20px;
  background: #111;
  color: white;
  margin: 30px;
}

.video-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  justify-items: center;
}

.video-card {
  background: #222;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
  transition: transform 0.3s ease;
  width: 100%;
  max-width: 330px;
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 0.6s ease forwards;
  animation-delay: calc(var(--card-index) * 0.1s);
}

.video-card:hover {
  transform: translateY(-5px);
}

.video-card img {
  width: 100%;
  height: 170px;
  object-fit: cover;
}

.card-info {
  padding: 14px 12px;
  text-align: center;
}

.card-info h5 {
  margin-bottom: 4px;
  font-size: 1rem;
  color: #00ffc3;
}

.card-info p {
  font-size: 0.85rem;
  color: #ccc;
  margin-bottom: 10px;
}

.play-btn {
  background: linear-gradient(to right, #00c853, #64dd17);
  border: none;
  padding: 8px 16px;
  border-radius: 50px;
  font-size: 1.1rem;
  color: white;
  cursor: pointer;
  transition: 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.play-btn:hover {
  background: linear-gradient(to right, #64dd17, #00c853);
  transform: scale(1.05);
}

.play-btn .icon {
  color: #00ff00;
  font-size: 1.2rem;
}

/* Animation */
@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Grid */
@media (max-width: 992px) {
  .video-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .video-grid {
    grid-template-columns: 1fr;
  }
}
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.9);
}

.modal-content {
  margin: auto;
  padding: 0;
  width: 80%;
  max-width: 800px;
  position: relative;
}

.close-btn {
  color: #fff;
  position: absolute;
  top: -40px;
  right: 0;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
}

/* Fade-up animation */
@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive */
@media (max-width: 992px) {
  .music-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .music-grid {
    grid-template-columns: 1fr;
  }

  .modal-content iframe {
    height: 250px;
  }
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


   <section class="hero"  style="background: url('../images/banner 2.jpg'); margin-top: 72px;">
      <div class="hero-content">
        <h1>100,000+ Free Sound Effects</h1>
        <p>All royalty-free for use in your projects. Instantly download and use.</p>
        <a href="music.php" class="btn primary">Browse Sounds</a>
      </div>
    </section>
<!-- Popular Artists Section -->
<!-- <section class="popular-artists" style="margin-top: 100px;">

  <div class="section-header">
    <h2>Popular artists</h2>
    <a href="all-artists.php" class="show-all">Show all</a>
  </div>

  <div class="artist-slider-wrapper">
    <button class="slider-btn left">&#10094;</button>
    <div class="artist-slider"> -->
      <!-- Artist cards -->
      <!-- <div class="artist-card">
        <img src="../images/young_stunners.jpg" alt="Young Stunners">
        <h4>Young Stunners</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/afusic.jpg" alt="Afusic">
        <h4>Afusic</h4>
        <p>Artist</p>
      </div> -->
      <!-- <div class="artist-card">
        <img src="../images/atif_aslam.jpg" alt="Atif Aslam">
        <h4>Atif Aslam</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/arjit_singh.jpg" alt="Arjit Singh">
        <h4>Arjit Singh</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/anuv_jain.jpg" alt="Anuv Jain">
        <h4>Anuv Jain</h4>
        <p>Artist</p>
      </div> -->
      <!-- <div class="artist-card">
        <img src="../images/asim_azhar.jpg" alt="Asim Azhar">
        <h4>Asim Azhar</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/bayan.jpeg" alt="Bayaan">
        <h4>Bayaan</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/Ap_Dhillon.jpg" alt="Ap Dhillon">
        <h4>Ap Dhillon</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/AUR.jpg" alt="AUR">
        <h4>AUR</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/shubh.jpg" alt="Shubh">
        <h4>Shubh</h4>
        <p>Artist</p>
      </div> -->
      <!-- <div class="artist-card">
        <img src="../images/abdul_hannan.jpg" alt="ABdul Hannan">
        <h4>Abdul Hannan</h4>
        <p>Artist</p>
      </div>
      <div class="artist-card">
        <img src="../images/pritam_artist.jpeg" alt="Pritam">
        <h4>Pritam</h4>
        <p>Artist</p>
      </div>
    </div>
    <button class="slider-btn right">&#10095;</button>
  </div>
</section> -->


  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FontAwesome CDN for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      <!-- Popular Artists Section -->
<section class="popular-artists" style="margin-top: 100px;">

  <div class="section-header">
    <h2 class="searchable">Popular artists</h2>
    <a href="all-artists.php" class="show-all">Show all</a>
  </div>

  <div class="artist-slider-wrapper">
    <button class="slider-btn left">&#10094;</button>
    <div class="artist-slider">
      <!-- Artist cards -->
      <div class="artist-card">
        <div class="song-card">
        <a href="youngStunner.php?name=youngstunner"><img src="../images/young_stunners.jpg" alt="Young Stunners"></a>
        <h4 class="searchable">Young Stunners</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="AtifAslam.php?name=AtifAslam"><img src="../images/atif_aslam.jpg" alt="Atif Aslam"></a>
        <h4 class="searchable">Atif Aslam</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="Shubh.php?name=Shubh"><img src="../images/anuv_jain.jpg" alt="Anuv Jain"></a>
        <h4 class="searchable">Anuv Jain</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="AsimAzhar.php?name=AsimAzhar"><img src="../images/asim_azhar.jpg" alt="Asim Azhar"></a>
        <h4 class="searchable">Asim Azhar</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="Bayan.php?name=Bayan"><img src="../images/bayan.jpeg" alt="Bayaan"></a>
        <h4 class="searchable">Bayaan</h4>
        <pclass="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="AUR.php?name=AUR"><img src="../images/AUR.jpg" alt="AUR"></a>
        <h4 class="searchable">AUR</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="Abdul_hannan.php?name=AbdulHannan"><img src="../images/abdul_hannan.jpg" alt="Abdul Hannan"></a>
        <h4 class="searchable">Abdul Hannan</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>

      <div class="artist-card">
        <div class="song-card">
        <a href="artist_profile_page.php?name=Pritam"><img src="../images/pritam_artist.jpeg" alt="Pritam"></a>
        <h4 class="searchable">Pritam</h4>
        <p class="searchable">Artist</p>
      </div>
      </div>
    </div>
    <button class="slider-btn right">&#10095;</button>
  </div>
</section>


    <!-- Latest Music Section -->
     
<section class="latest-music-section">
  <h3 class="section-title">Latest Music</h3>
  <div class="music-grid">
    
    <!-- Music Card 1 -->
     <div class="song-card">
    <div class="music-card">
      <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/podcast-show-design-template-419e3d04e6c37486f06b4493c1916cc7.jpg" alt="Music Cover">
      <div class="card-info">
      
        <h5 class="searchable">Groove Anthem</h5>
        <p class="searchable">Artist: The Melodics</p>
        <button class="play-btn" onclick="playAudio(this)">
          ▶
        </button>
        <audio src="../AUDIO/anthem-of-victory-111206.mp3"></audio>
      </div>
    </div>
      </div>

    <!-- Music Card 2 -->
     <div class="song-card">
    <div class="music-card">
      <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/square-abstract-album-cover-template-design-bd514bc801c075669ff5a247cc4c91e3.jpg" alt="Music Cover">
      <div class="card-info">
       
        <h5 class="searchable">Blue Notes</h5>
        <p class="searchable">Artist: Jazz Cats</p>
        <button class="play-btn" onclick="playAudio(this)">
          ▶
        </button>
        <audio src="../AUDIO/the-best-jazz-club-in-new-orleans-164472.mp3"></audio>
      </div>
      </div>
    </div>

    <!-- Music Card 3 -->
     <div class="song-card">
    <div class="music-card">
      <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/black-floral-illustrative-album-cover-design-template-67892cec24b9ff7bed87bb1b30890a5a.jpg" alt="Music Cover">
      <div class="card-info">
        
        <h5 class="searchable">Raga Melody</h5>
        <p class="searchable">Artist: Sitar Maestro</p>
        <button class="play-btn" onclick="playAudio(this)">
          ▶
        </button>
        <audio src="../AUDIO/sitar-melody-raga-jog-364969.mp3"></audio>
      </div>
      </div>
    </div>

    <!-- Music Card 4 -->
     <div class="song-card">
    <div class="music-card">
      <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/cd-mixtape-album-cover-artwork-template-design-e7e11c3df5575b80999cebb16000f67b.jpg" alt="Music Cover">
      <div class="card-info">
        
        <h5 class="searchable">Electric Dreams</h5>
        <p class="searchable">Artist: The Ampersands</p>
        <button class="play-btn" onclick="playAudio(this)">
          ▶
        </button>
        <audio src="../AUDIO/electric-lullaby-16242.mp3"></audio>
      </div>
      </div>
    </div>

    <!-- Music Card 5 -->
     <div class="song-card">
    <div class="music-card">
      <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/cd-mixtape-album-cover-artwork-template-design-457597dbbec9e191a6b47af5381f0478.jpg" alt="Music Cover">
      <div class="card-info">
        
        <h5 class="searchable">Beat Drop</h5>
        <p class="searchable">Artist: DJ Flow</p>
        <button class="play-btn" onclick="playAudio(this)">
          ▶
        </button>
        <audio src="../AUDIO/bridge-mix-beat-drop-13761.mp3"></audio>
      </div>
    </div>
      </div>

    <!-- Music Card 6 -->
     <div class="song-card">
    <div class="music-card">
      <img src="../images/download.jpg" alt="Music Cover">
      <div class="card-info">
       
        <h5 class="searchable">Lost Frequencies</h5>
        <p class="searchable">Artist: DJ Nova</p>
        <button class="play-btn" onclick="playAudio(this)">
          ▶
        </button>
        <audio src="../AUDIO/bossa-nova-track-312167.mp3"></audio>
      </div>
      </div>
    </div>

  </div>
</section>


<section class="latest-music-section">
  <h3 class="section-title">🎬 Latest Videos</h3>
  <div class="music-grid">

    <!-- Video Card 1 -->
     <div class="song-card">
    <div class="music-card" style="--card-index: 1;">
      <img src="https://img.youtube.com/vi/ATVZksWtw2M/hqdefault.jpg" alt="Video Thumbnail">

      <div class="card-info">
      
        <h5 class="searchable">City Lights</h5>
        <p class="searchable">Artist: Urban Beats</p>
        <button class="play-btn" data-video="https://www.youtube.com/embed/ATVZksWtw2M">
          <span class="icon">▶</span> Play
        </button>
      </div>
      </div>
    </div>

    <!-- Video Card 2 -->
     <div class="song-card">
    <div class="music-card" style="--card-index: 2;">
      <img src="https://img.youtube.com/vi/aBwz8kxQZKE/hqdefault.jpg" alt="Video Thumbnail">
      <div class="card-info">
        
        <h5 class="searchable">Bollywood Dance</h5>
        <p class="searchable">Artist: Desi Crew</p>
        <button class="play-btn" data-video="https://www.youtube.com/embed/aBwz8kxQZKE">
          <span class="icon">▶</span> Play
        </button>
      </div>
      </div>
    </div>

    <!-- Video Card 3 -->
     <div class="song-card">
    <div class="music-card" style="--card-index: 3;">
      <img src="https://img.youtube.com/vi/39uaxOpHweQ/hqdefault.jpg" alt="Video Thumbnail">
      <div class="card-info">
        
        <h5 class="searchable">Wilderness Journey</h5>
        <p class="searchable">Director: Nature Films</p>
        <button class="play-btn" data-video="https://www.youtube.com/embed/39uaxOpHweQ">
          <span class="icon">▶</span> Play
        </button>
      </div>
      </div>
    </div>
    <!-- Video Card 4 -->
     <div class="song-card">
    <div class="music-card" style="--card-index: 3;">
      <img src="https://img.youtube.com/vi/jXHOHOYkbYc/hqdefault.jpg" alt="Video Thumbnail">
      <div class="card-info">
       
        <h5 class="searchable">Animated Tale</h5>
        <p class="searchable">Creator: Animates Studio</p>
        <button class="play-btn" data-video="https://www.youtube.com/embed/jXHOHOYkbYc">
          <span class="icon">▶</span> Play
        </button>
      </div>
      </div>
    </div>
    <!-- Video Card 5 -->
     <div class="song-card">
    <div class="music-card" style="--card-index: 3;">
      <img src="https://img.youtube.com/vi/OjCf3JmCTpk/hqdefault.jpg" alt="Video Thumbnail">
      <div class="card-info">
        
        <h5 class="searchable">Live Performance</h5>
        <p class="searchable">Director: Rocknight</p>
        <button class="play-btn" data-video="https://www.youtube.com/embed/OjCf3JmCTpk">
          <span class="icon">▶</span> Play
        </button>
      </div>
      </div>
    </div>
    <!-- Video Card 6 -->
     <div class="song-card">
    <div class="music-card" style="--card-index: 3;">
      
      <img src="https://img.youtube.com/vi/6g0prFClKgg/hqdefault.jpg" alt="Video Thumbnail">
      <div class="card-info">

        <h5 class="searchable">Dreamy Universe</h5>
        <p class="searchable">Artist: Cosmic Vibes</p>
        <button class="play-btn" data-video="https://www.youtube.com/embed/6g0prFClKgg">
          <span  class="icon">▶</span> Play
        </button>
        
      </div>
      </div>
    </div>

  </div>
</section>

<!-- MODAL -->
<div id="videoModal" class="modal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <iframe id="videoFrame" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
  </div>
</div>
    <section id="community" class="community-section section-spacing text-center animate-section">
        <div class="container section-content-wrapper">
            <h2 class="section-title mb-4 animate-element fade-in-up">What Our Community Says</h2>
            <p class="lead animate-element fade-in-up delay-1">Read reviews and ratings from fellow enthusiasts, or share your own!</p>
            <div class="row section-row justify-content-center mt-4 reviews-row g-4">
                <div class="col-md-6 review-card animate-element fade-in-left delay-2">
                    <div class="card bg-dark text-white p-4 h-100">
                        <h5 class="card-title">"Incredible Variety!"</h5>
                        <p class="card-text">"SOUND Group has an astonishing collection of regional and English content. The quality is superb!"</p>
                        <div class="rating-stars">
                            <span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9734;</span>
                        </div>
                        <p class="card-text-small"><small> - Alex P.</small></p>
                    </div>
                </div>
                <div class="col-md-6 review-card animate-element fade-in-right delay-2">
                    <div class="card bg-dark text-white p-4 h-100">
                        <h5 class="card-title">"Seamless Experience"</h5>
                        <p class="card-text">"The website is so easy to navigate, and finding new music is a joy. Highly recommended!"</p>
                        <div class="rating-stars">
                            <span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span>
                        </div>
                        <p class="card-text-small"><small> - Sarah L.</small></p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section style="margin:90px; " id="about-contact" class="about-contact-section section-spacing animate-section">
        <div class="container section-content-wrapper">
            <h2 class="section-title text-center mb-5 animate-element fade-in-up">About Us & Get in Touch</h2>
            <div class="row section-row g-5">
                <div class="col-md-6 about-info-col animate-element fade-in-left delay-1">
                    <h3 class="sub-section-title mb-3">Our Mission</h3>
                    <p class="lead">SOUND Group is dedicated to curating and hosting a diverse range of music and videos, bridging cultural gaps and providing endless entertainment. We believe in the power of sound and visual storytelling to connect people globally.</p>
                    <p>Our platform offers a rich collection of both timeless classics and the latest hits, available in various regional languages and English. We strive to be your go-to source for entertainment, fostering a community where users can discover, review, and share their passion for media.</p>
                </div>
               <div class="col-md-6 contact-form-col animate-element fade-in-right delay-1">
  <h3 class="sub-section-title mb-3">Contact Us</h3>
  <form class="contact-form" id="dynamicContactForm">
    <div class="mb-3 contact-form-group animate-element fade-in-up delay-2">
      <label for="contactName" class="form-label">Name</label>
      <input type="text" class="form-control" id="contactName" name="name" required>
    </div>
    <div class="mb-3 contact-form-group animate-element fade-in-up delay-3">
      <label for="contactEmail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="contactEmail" name="email" required>
    </div>
    <div class="mb-3 contact-form-group animate-element fade-in-up delay-4">
     <label for="contactSubject" class="form-label">Subject</label>
<select class="form-control" id="contactSubject" name="subject">
  <option value="">-- Select a Subject --</option>
  <option value="General Inquiry">General Inquiry</option>
  <option value="Bug Report">Bug Report</option>
  <option value="Feature Request">Feature Request</option>
  <option value="Feedback">Feedback</option>
  <option value="Business/Collaboration">Business/Collaboration</option>
</select>

    </div>
    <div class="mb-3 contact-form-group animate-element fade-in-up delay-5">
      <label for="contactMessage" class="form-label">Message</label>
      <textarea class="form-control" id="contactMessage" name="message" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-spotify contact-submit-button animate-element fade-in-up delay-6">Send Message</button>
    <div id="contactResult" class="mt-3 text-success"></div>
  </form>
</div>

        </div>
    </section>

    <!-- <section id="user-portal" class="user-portal-section section-spacing animate-section">
        <div class="container section-content-wrapper text-center">
            <h2 class="section-title mb-5 animate-element fade-in-up">User & Administrator Portal</h2>
            <div class="row section-row g-4 justify-content-center">
                <div class="col-md-5 user-role-card animate-element fade-in-left delay-1">
                    <div class="card bg-dark text-white p-4 h-100">
                        <h3 class="card-title mb-3">User Capabilities</h3>
                        <ul class="text-start list-unstyled user-features-list">
                            <li><i class="fas fa-user-plus me-2 text-spotify-green"></i> Register/Create Account (Unique UserID)</li>
                            <li><i class="fas fa-search me-2 text-spotify-green"></i> Search Music/Video (Name, Artist, Year, Album, etc.)</li>
                            <li><i class="fas fa-edit me-2 text-spotify-green"></i> Add/Modify Reviews</li>
                            <li><i class="fas fa-star me-2 text-spotify-green"></i> Add/Modify Ratings</li>
                            <li><i class="fas fa-envelope me-2 text-spotify-green"></i> Mandatory Fields: Name, Address, Phone, Email (with validation)</li>
                        </ul>
                        <a href="#" class="btn btn-spotify mt-4">Register Now</a>
                    </div>
                </div>
                <div class="col-md-5 user-role-card animate-element fade-in-right delay-1">
                    <div class="card bg-dark text-white p-4 h-100">
                        <h3 class="card-title mb-3">Administrator Privileges</h3>
                        <ul class="text-start list-unstyled admin-features-list">
                            <li><i class="fas fa-plus-circle me-2 text-spotify-green"></i> Add Music files with information</li>
                            <li><i class="fas fa-video me-2 text-spotify-green"></i> Add Video files with information</li>
                            <li><i class="fas fa-tags me-2 text-spotify-green"></i> Create Categories (Year, Artist, Album etc.)</li>
                            <li><i class="fas fa-trash-alt me-2 text-spotify-green"></i> Delete Music files</li>
                            <li><i class="fas fa-trash-alt me-2 text-spotify-green"></i> Delete Video files</li>
                            <li><i class="fas fa-users-cog me-2 text-spotify-green"></i> Create/Manage Users/Logins</li>
                            <li><i class="fas fa-cog me-2 text-spotify-green"></i> Manage Website Information/Details</li>
                        </ul>
                        <a href="#" class="btn btn-spotify-outline mt-4">Admin Login (Conceptual)</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  AOS.init();

  const slider = document.querySelector(".artist-slider");
  const leftBtn = document.querySelector(".slider-btn.left");
  const rightBtn = document.querySelector(".slider-btn.right");

  leftBtn.addEventListener("click", () => {
    slider.scrollBy({ left: -300, behavior: "smooth" });
  });

  rightBtn.addEventListener("click", () => {
    slider.scrollBy({ left: 300, behavior: "smooth" });
  });

document.getElementById("dynamicContactForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);

  fetch("../backend/contact.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(response => {
    if (response.trim() === "success") {
      Swal.fire({
        icon: 'success',
        title: 'Message Sent',
        text: '✅ Your message has been submitted successfully!',
        background: '#1b1b1b',
        color: '#eaeaea',
        confirmButtonColor: '#1db954'
      });
      form.reset();
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: response,
        background: '#1b1b1b',
        color: '#eaeaea',
        confirmButtonColor: '#1db954'
      });
    }
  })
  .catch(() => {
    Swal.fire({
      icon: 'error',
      title: 'Server Error',
      text: '❌ Something went wrong. Please try again later.',
      background: '#1b1b1b',
      color: '#eaeaea',
      confirmButtonColor: '#1db954'
    });
  });
});


</script>
<script>
   let currentAudio = null;

  // 🎵 AUDIO BUTTON HANDLER
  const audioButtons = document.querySelectorAll(".music-card .play-btn:not([data-video])");

  function playAudio(button) {
    const audio = button.nextElementSibling;

    if (currentAudio && currentAudio !== audio) {
      currentAudio.pause();
      currentAudio.currentTime = 0;
    }

    if (audio.paused) {
      audio.play();
      currentAudio = audio;
    } else {
      audio.pause();
    }
  }

document.addEventListener("DOMContentLoaded", function () {
  const videoButtons = document.querySelectorAll(".play-btn[data-video]");
  const modal = document.getElementById("videoModal");
  const videoFrame = document.getElementById("videoFrame");
  const closeBtn = document.querySelector(".close-btn");

  if (!modal || !videoFrame || !closeBtn) {
    console.error("Modal elements not found.");
    return;
  }

  videoButtons.forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const videoURL = btn.getAttribute("data-video") + "?autoplay=1";
      videoFrame.src = videoURL;
      modal.style.display = "block";
    });
  });

  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
    videoFrame.src = "";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
      videoFrame.src = "";
    }
  });
});


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

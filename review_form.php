<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.html");
    exit();
}

// Check if user is logged in and fullName is set
$fullName = isset($_SESSION['fullName']) ? $_SESSION['fullName'] : null;
$initial = $fullName ? strtoupper($fullName[0]) : '';
?>

<?php if (isset($_GET['success'])): ?>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
      icon: 'success',
      title: 'Thank You!',
      text: 'Your review has been submitted.',
      background: '#1b1b1b',
      color: '#eaeaea',
      confirmButtonColor: '#1db954'
    });
  });
</script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit a Review</title>
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
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg-primary);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: var(--text-main);
    }

    .review-container {
      background-color: var(--bg-secondary);
      padding: 30px;
      width: 100%;
      max-width: 450px;
      border-radius: var(--radius);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      border: 1px solid var(--border-color);
    }

    h2 {
      margin-top: 0;
      font-size: 24px;
      color: var(--green);
    }

    label {
      display: block;
      margin: 20px 0 8px;
      font-weight: 500;
      color: var(--text-main);
    }

    textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--border-color);
      background-color: var(--bg-primary);
      color: var(--text-main);
      border-radius: var(--radius);
      font-size: 16px;
      resize: vertical;
      min-height: 100px;
    }

    button {
      margin-top: 25px;
      width: 100%;
      background-color: var(--green);
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      padding: 12px;
      border-radius: var(--radius);
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: var(--green-dark);
    }

    .star-rating {
      display: flex;
      flex-direction: row-reverse;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      font-size: clamp(24px, 5vw, 48px);
    }

    .star-rating input {
      display: none;
    }

    .star-rating label {
      flex: 1;
      text-align: center;
      color: var(--border-color);
      cursor: pointer;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
      color: #fbbf24;
      transform: scale(1.2);
    }

    /* 🔁 Responsive Design */
    @media screen and (max-width: 600px) {
      .review-container {
        padding: 20px;
        margin: 0 15px;
        max-width: 100%;
      }

      h2 {
        font-size: 20px;
      }

      textarea,
      button {
        font-size: 14px;
      }

      .star-rating {
        font-size: 28px;
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
  <div class="review-container">
    <h2>Leave a Review</h2>

    <form action="../backend/submit_review.php" method="POST">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
      <input type="hidden" name="rating" id="rating-value" value="0">

      <label>Rating</label>
      <div class="star-rating">
        <input type="radio" id="star5" name="stars" value="5">
        <label for="star5">&#9733;</label>

        <input type="radio" id="star4" name="stars" value="4">
        <label for="star4">&#9733;</label>

        <input type="radio" id="star3" name="stars" value="3">
        <label for="star3">&#9733;</label>

        <input type="radio" id="star2" name="stars" value="2">
        <label for="star2">&#9733;</label>

        <input type="radio" id="star1" name="stars" value="1">
        <label for="star1">&#9733;</label>
      </div>

      <label for="comment">Your Review</label>
      <textarea id="comment" name="comment" placeholder="Write something helpful..." required></textarea>

      <button type="submit">Submit Review</button>
    </form>
  </div>

  <script>
    const starRadios = document.querySelectorAll('input[name="stars"]');
    const ratingValue = document.getElementById('rating-value');

    starRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        ratingValue.value = radio.value;
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

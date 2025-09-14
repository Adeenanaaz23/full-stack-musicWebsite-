<?php
include '../backend/db.php';

if (isset($_GET['query'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['query']);

    // You can also include more conditions for other tables
    $sql = "SELECT * FROM songs WHERE title LIKE '%$searchTerm%' OR artist LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Search Results for "<?php echo htmlspecialchars($searchTerm); ?>"</h2>

    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
        <div class="grid-layout__songs">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="song-card">
                <img src="../uploads/<?php echo $row['image']; ?>" class="song-img" alt="<?php echo $row['title']; ?>">
                <h5><?php echo $row['title']; ?></h5>
                <p><?php echo $row['artist']; ?></p>
                <audio controls>
                    <source src="../uploads/<?php echo $row['audio']; ?>" type="audio/mpeg">
                </audio>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>
</html>


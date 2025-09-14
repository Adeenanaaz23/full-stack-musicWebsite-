<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "vibescapedb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$email = trim($_POST['email']);
$password = $_POST['password'];
$name = trim($_POST['name']);
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$gender = $_POST['gender'];

// Validate date (basic)
$months = [
    'January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06',
    'July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12'
];

if (!isset($months[$month])) {
    die("Invalid month selected. <a href='../frontend/signup.html'>Try again</a>");
}

$dob = $year . '-' . $months[$month] . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (email, password, name, dob, gender) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $email, $hashed_password, $name, $dob, $gender);

if ($stmt->execute()) {
    echo "Registration successful!";
header("Location: ../view/home.php"); // or homepage.php, index.html, etc.
exit();
} else {
    echo "Error: " . $stmt->error . "<br><a href='../frontend/signup.html'>Try again</a>";
}

$stmt->close();
$conn->close();
?>
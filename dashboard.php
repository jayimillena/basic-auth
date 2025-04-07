<?php
session_start(); // Must be at the top before anything else

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "basic-auth");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mobile Legends Theme</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 shadow-lg flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-400">Mobile Legends Dashboard</h1>
        <a href="logout.php" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
    </nav>

    <!-- Hero Section -->
    <div class="bg-cover bg-center h-64 flex items-center justify-center" style="background-image: url('https://i.imgur.com/fYcF6za.jpg');">
        <h1 class="text-4xl font-extrabold text-white bg-black bg-opacity-50 p-4 rounded-lg">Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
    </div>

    <!-- Dashboard Content -->
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-4">Your Profile</h2>
        <div class="bg-gray-800 p-4 rounded-lg shadow-md">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Rank:</strong> Mythic</p>
            <p><strong>Win Rate:</strong> 80%</p>
        </div>
    </div>

</body>
</html>

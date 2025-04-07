<?php
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Database connection (Modify with your credentials)
    $conn = new mysqli("localhost", "root", "", "basic-auth");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, username, password, name FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $db_username, $db_password, $name);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['name'] = $name ;
            header("Location: dashboard.php");
            exit();
        } else {
            $errors[] = "Invalid password.";
        }
    } else {
        $errors[] = "Username not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robucks - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Login</h2>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-3">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block font-medium">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded-lg" placeholder="Enter username" required>
            </div>

            <div>
                <label for="password" class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg" placeholder="Enter password" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Login</button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Don't have an account? <a href="register.php" class="text-blue-500">Create one for free!</a>
        </p>
    </div>

</body>
</html>

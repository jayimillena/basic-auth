<?php
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Simple validation
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed with registration logic (Save to DB)
    if (empty($errors)) {
        // Hash password (for security)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Sample database connection (modify accordingly)
        $conn = new mysqli("localhost", "root", "", "basic-auth");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $name);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful! Please log in.";
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Something went wrong. Try again.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robucks - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Register</h2>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-3">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST" class="space-y-4">

           <div>
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg" placeholder="Enter name" required>
            </div>

            <div>
                <label for="username" class="block font-medium">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded-lg" placeholder="Enter username" required>
            </div>

            <div>
                <label for="password" class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg" placeholder="Enter password" required>
            </div>

            <div>
                <label for="confirm_password" class="block font-medium">Confirm Password</label>
                <input type="password" name="confirm_password" class="w-full p-2 border rounded-lg" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Register</button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Already have an account? <a href="index.php" class="text-blue-500">Login here</a>
        </p>
    </div>

</body>
</html>

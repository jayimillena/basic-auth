<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robucks - Register</title>
</head>
<body>
    <form action="register_process.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter username">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter password">
        <label for="password">Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm password">
        <input type="submit" name="register_btn" value="Register"> 
        <a href="index.php">Do you have an existing account?</a>
    </form> 
</body>
</html>
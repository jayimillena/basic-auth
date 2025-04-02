<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robucks - Login</title>
</head>
<body>
    <form action="login_process.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter username">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter password">
        <input type="submit" name="login_btn" value="Login"> 
        <a href="register.php">Create fo free!</a>
    </form>
</body>
</html>
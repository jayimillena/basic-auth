<?php
    $con = mysqli_connect('localhost', 'root', '', 'basic-auth') or die("Failure to connect!");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $login_btn = $_POST['login_btn'];
    
    if ($login_btn)
    {
        if (!empty($username) && !empty($password))
        {
            $query = "SELECT `username`, `password` FROM users 
                      WHERE `username` = '$username' && `password` = '$password'";
            if(mysqli_fetch_array(mysqli_query($con, $query)))
            {
                header('location: dashboard.php');
            } 
            else 
            {
                echo "Invalid account! <a href='index.php'> Back </a>";
            }
        }       
        else 
        {
            echo "Invalid account! <a href='index.php'> Back </a>";
        }
    }
?>
<?php
    $con = mysqli_connect('localhost', 'root', '', 'basic-auth') or die("Failure to connect!");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $register_btn = $_POST['register_btn'];
    
    if ($register_btn)
    {
        if (!empty($username) && !empty($password))
        {
            if ($password == $confirm_password)
            {   
                if (strlen($password) > 9 && strlen($password) < 255)
                {
                    $check_username = "SELECT count(`username`) as count FROM users WHERE `username` = '$username'";

                    $row = mysqli_fetch_array(mysqli_query($con, $check_username));
                    if ($row['count'] > 0) 
                    {
                        echo "Username already taken!";
                    }   
                    else 
                    {
                        $query = "INSERT INTO `users` 
                            (
                                `username`, 
                                `password`
                            ) 
                            VALUES 
                            (
                                '$username', 
                                '$password'
                            )";

                        mysqli_query($con, $query);
                        
                        echo "You are succesfuly register </br>";
                        echo "<a href='index.php'> Login here</a>";
                    }
                }
                else 
                {
                    echo "Password must be minumum of 8 and maximum of 255";
                }
                
            }       
            else 
            {
                echo "Password doesn't match!";
            }
        }
    }
?>
<?php
    session_destroy();
    session_unset();
    header("Location: index.php");

    if (ini_get("session.use_cookies"))
    {
        setcookie(session_name(), '', time() - 42000, '/'); 
    }
s?>

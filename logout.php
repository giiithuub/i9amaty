 <?php
    session_start();

        unset($_SESSION['auth']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        $_SESSION['message'] = "Logged Out Successfully";

// Logout

    // Clear cookies
    setcookie('auth', '', time() - 3600, '/');
    setcookie('user_id', '', time() - 3600, '/');
    setcookie('user_name', '', time() - 3600, '/');
    setcookie('user_email', '', time() - 3600, '/');
   


    header('Location: index.php');

    ?>
<?php

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Query to check if the email exists in the database
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        // Email is already registered
        echo 'unavailable';
    } else {
        // Email is available
        echo 'available';
    }
} else {
    // Invalid request
    echo 'invalid';
}
?>
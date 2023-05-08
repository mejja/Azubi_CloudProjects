<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $redirect_url = '';
    if ($username === 'admin' && $password === 'password') {
        // Set the redirect URL if login is successful
        $redirect_url = 'success.php';
    } else {
        // Set an error message if the login is not successful
        $error_message = 'error.php';
    }
}

// If the redirect URL is set, redirect to it
if (!empty($redirect_url)) {
    header("Location: $redirect_url");
    exit;
}

// If an error message is set, display it
if (!empty($error_message)) {
    header("Location: $error_message");
}
?>
<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: user_login.php");
exit();
}
?>
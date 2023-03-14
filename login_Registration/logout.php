<?php
// Initialize the session
session_start();
?>
<?php include('../db_connect.php');
if (!isset($_SESSION["administrative_id"]) && !isset($_SESSION["customer_id"])) {

    echo '<script >';
    echo 'window.location="login.php"';
    echo '</script>';
    exit;
}


// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_unset();

// Redirect to login page
header("location: login.php");
exit;
?>
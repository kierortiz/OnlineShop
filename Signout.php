<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    // Redirect to Home page
    header("location: Home.php");
    exit;
}

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 ?>
    <script>
        alert("Your now Logout");
    </script>
 <?php
// Redirect to Home page
header("refresh:0; Home.php");
exit;
?>
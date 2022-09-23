<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    // Redirect to Home page
    header("Location: 404.html");
    exit;
}
?>
<script>
    alert("Successfuly Signout!")
</script>
<?php
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to Home page
header("refresh:0; /Project/Home.php");
exit;
?>
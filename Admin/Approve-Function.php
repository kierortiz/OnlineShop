<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    // Redirect to Home page
    header("Location: 404.html");
    exit;
}else if($_SESSION["name"] == null || $_SESSION["position"] == null){
    // Redirect to Home page
    header("Location: 404.html");
    exit;
}
include "db_conn.php";
$get_id = $_GET['id'];

$update="UPDATE tbl_order SET ORDER_STATUS = 'ACCEPTED' WHERE ORDER_ID = '$get_id'";
$conn->query($update);

$update1="UPDATE tbl_res SET RES_PRODSTAT = 'ACCEPTED' WHERE RES_ID = '$get_id'";
$conn->query($update1);

header("location: Admin-Logs.php");

?>

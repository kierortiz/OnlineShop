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
if(!empty($_GET['id'])){
    $get_id = $_GET['id'];
    $update="UPDATE tbl_account SET ACC_POSITION = 'Unemployed' WHERE ACC_ID = '$get_id'";
    $conn->query($update);
    header("refresh:0; Admin-Accounts.php");
}

if(!empty($_GET['prodid'])){
    $get_id = $_GET['prodid'];
    $update="UPDATE tbl_product SET PROD_STATUS = 'ARCHIVED' WHERE PROD_ID = '$get_id'";
    $conn->query($update);
    header("refresh:0; Admin-Page.php");
}
?>
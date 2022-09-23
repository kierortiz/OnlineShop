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
// $_SESSION["username"] = $user;          
// $_SESSION["admin"] = $uposition; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Archive.css" type="text/Css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Blessed4J's || Admin Archive</title>
</head>
<body>
    <div class="container">
        <div class="home">
            <a class="homebtn" href="/Project/Home.php"><i class="fa fa-home"></i> Blessed4J's</a>
        </div>
        <div class="user">
            <a class="button" href="Logout.php">
                <img src="Img/exit.svg" alt="logout" class="logout">
                <div class="logname">    
                    LOGOUT
                </div>
            </a>
            <p class="username"><?php echo $_SESSION["name"];?></p>
        </div>        
        <div class="navigation">
            <a id="acc" href="Admin-Accounts.php"><span class="acc"></span> Accounts</a>
            <a id="log" href="Admin-Logs.php"><span class="log"></span> Logs</a>
            <a id="inv" href="Admin-Page.php"><span class="inv"></span> Inventory</a>
            <a id="rep" href="Admin-Report.php"><span class="rep"></span> Reports</a>
            <a id="arc" href="Admin-Archive.php"><span class="arc"></span> Archive</a>
        </div>
    </div>
</body>
</html>
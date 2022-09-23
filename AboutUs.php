<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     //When Not Login Return to this Page
//     header("refresh:0; Home.php#open-login");    
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/About.css">
    <link rel="stylesheet" href="CSS/Navigation.css">
    <!-- <link rel="stylesheet" href="CSS/Home.css"> -->
    <title>About Us || Blessed4J's Minimart</title>
</head>
<body>
    <div class="container">
        <div class="blue"></div>
        <div class="diamond"></div>
        <div class="blue2"></div>
        <div class="diamond2"></div>
            <div class="subdiamond"></div>

        <div class="popupContainer">
            <div class="interior">
            <?php                
                // Check if the user is logged in, if not then redirect him to login page
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    // header("location: ContactUs.html");
                    // exit;
                    echo '<a class="btn" href="#open-login">';
                    echo '<img class="userPic" src="Img/user.svg" alt="login">';
                    echo '</a>';
                    
                    //<!-- Login Popup -->
                    echo' <div id="open-login" class="modal-window">
                        <div>
                            <a href="AboutUs.php" title="Close" class="modal-close">Close</a>
                            <form method="POST" action="Login-Function.php">
                                <center>
                                    <div class ="input">
                                        <h1>LOGIN</h1>
                                        <input type="text" name="username" required autofocus>
                                        <!-- <img class=usericon src="Img/userIcon.svg"/> -->
                                        <label class="user" >Username</label>
                                        <span class="span1"></span>

                                        <input type= "password" name="password" required>
                                        <label class="password">Password</label>
                                        <span class="span2"></span>

                                        <input type= "submit"  name="LogSubmit" value="Login" class="loginbtn">
                                        <a class="signuplink" href="#open-signin">Create Account</a>
                                    </div>   
                                </center>
                            </form>
                        </div>
                    </div> 
                    <!-- Signup Popup -->
                    <div id="open-signin" class="modal-window">
                        <div>
                            <a href="AboutUs.php" title="Close" class="modal-close">Close</a>
                            <a href="#open-login" title="Back" class="modal-back">Back</a>
                            <form method="POST" action="Signin-Function.php">
                                <center>
                                    <div class ="signin">
                                        <h1>Sign Up</h1><br>
                                        <input class=firstname type="text" name="fname" required autofocus><br>
                                        <label class="first">First Name</label><br>
                                        <span class=span3></span>

                                        <input class=lastname type="text" name="lname" required><br>              
                                        <label class="last">Last Name</label><br>
                                        <span class=span4></span>
                                        
                                        <input type="tel" name="cont" required pattern="[0-9]{11}"><br>
                                        <label class="cnumber">Contact Number</label><br>
                                        <span class=span5></span>

                                        <input class=us type="text" name="suser" required autofocus><br>
                                        <label class="suser">Username</label><br>
                                        <span class=span6></span>
                                        
                                        <input class="pass" type="password" name="spass" required 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" ><br>
                                        <label class="spassword">Password</label><br>
                                        <span class=span7></span>
                                         
                                        <input class="pass2" type="password" name="pass1" required
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" ><br>
                                        <label class="srpassword">Confirm Password</label><br>
                                        <span class=span8></span>
                                        
                                        
                                        <input type="submit" name="SignSubmit" value="Create Account" class="signinbtn">
                                    </div>   
                                </center>
                            </form>

                        </div>
                    </div>';
                }
                else {
                    // header("location: Ho.html");
                    echo '<a class="btn2" href="Signout.php">';
                    echo '<img class="userPic" src="Img/exit.svg" alt="signout">';
                    echo '</a>';
                }
            ?>
            </div>
        </div>
        <!-- Navigation Bar -->
        <div class="navigation">
            <a href="javascript:window.location.reload(true)" class="title">About Us</a>
            <input type="checkbox" class="toggler">
            <div class="hamburger"><div></div></div>
                <div class="menu">
                    <div>
                        <div>
                            <ul>
                                <?php            
                                // Check if the user is logged in
                                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                                    //This only show for Not login visitor  
                                     echo '<li><a class="home" href="Home.php">Home</a></li>';
                                     echo '<li><a href="Cart.php">Cart</a></li>';
                                     echo '<li><a href="ContactUs.php">Contact Us</a></li>';
                                     echo '<li><a href="AboutUs.php">About Us</a></li>';     
                                }
                                else if ($_SESSION["position"] !== null || $_SESSION["position"] !== null){
                                    //When Admin is Login
                                    echo '<li><a class="home" href="Home.php">Home</a></li>';
                                    echo '<li><a href="ContactUs.php">Contact Us</a></li>';//kahit wlana
                                    echo '<li><a href="AboutUs.php">About Us</a></li>';    //kahit wla na din
                                    echo '<li><a href="Admin/Admin-Page.php">Admin</a></li>';               
                                }
                                else{
                                    //This only show for login costumer
                                    echo '<li><a class="home" href="Home.php">Home</a></li>';
                                    echo '<li><a href="Cart.php">Cart</a></li>';
                                    echo '<li><a href="ContactUs.php">Contact Us</a></li>';
                                    echo '<li><a href="AboutUs.php">About Us</a></li>';
                                    echo '<li><a href="Profile.php">Account</a></li>';  
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>

        <div class="content">
            <div class="contentcontainer">
                <img src="Img/AboutUs.png" alt="people">
                <div class="about">
                    <p class="company">Company</p>
                    <p class="aboutus">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro cupiditate eum possimus quis perspiciatis nulla, molestias ullam, necessitatibus dolores accusamus sit voluptatem ipsa unde vitae sed magni rerum, illum ad.</p>
                </div>
            </div>
        </div>
        <div class="content2">
            <div class="contentcontainer2">
                <img src="Img/Male.png" alt="person">
                <div class="about2">
                    <p class="item">Mrs.</p>
                    <p class="item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro cupiditate eum possimus quis perspiciatis nulla, molestias ullam, necessitatibus dolores accusamus sit voluptatem ipsa unde vitae sed magni rerum, illum ad.</p>
                    <p class="item">Mrs.</p>
                    <p class="item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro cupiditate eum possimus quis perspiciatis nulla, molestias ullam, necessitatibus dolores accusamus sit voluptatem ipsa unde vitae sed magni rerum, illum ad.</p>
                </div>
                <img class="female" src="Img/Female.png" alt="person">
            </div>
        </div>
</body>
</html>
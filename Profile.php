<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //When Not Login Return to this Page
    header("refresh:0; Home.php#open-login");    
    exit;
}

include "db_conn.php"; 
$username = $_SESSION['username'];
$up="SELECT * FROM tbl_account WHERE ACC_USER = '$username'";
$result=$conn->query($up);
//display summarry
if($result->num_rows>0)
{
    $row = mysqli_fetch_array($result);
    $id=$row['ACC_ID'];
    $USER=$row['ACC_USER'];
    $PASS=$row['ACC_PASS'];
    $FNAME=$row['ACC_FNAME'];
    $LNAME=$row['ACC_LNAME'];
    $CONTACT=$row['ACC_CONTACT'];
    $EMAIL=$row['ACC_EMAIL'];
    $ADDRESS=$row['ACC_ADDRESS'];
    $CITY=$row['ACC_CITY'];

    $query = $conn->query("SELECT count(*) AS total FROM tbl_cart WHERE CART_USER='$username'");
    $result2 = mysqli_fetch_array($query);
    $query2 = $conn->query("SELECT SUM(CART_COMPPRICE) AS ptotal FROM tbl_cart WHERE CART_USER='$username'");
    $result3 = mysqli_fetch_array($query2);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Navigation.css">
    <link rel="stylesheet" href="CSS/Profile.css">
    <title>Profile || Blessed4J's Minimart</title>
  </head>
<body>
<div class="container">
        <div class="blue"></div>
        <div class="diamond"></div>
        <div class="popupContainer">
            <div class="interior">
            <?php
                // Check if the user is logged in
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    // Not login
                    echo '<a class="btn" href="#open-login">';
                    echo '<img class="userPic" src="Img/user.svg" alt="login">';
                    echo '</a>';
                    
                    //<!-- Login Popup -->
                    echo' <div id="open-login" class="modal-window">
                        <div>
                            <a href="Home.php" title="Close" class="modal-close">Close</a>
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
                                        <br><br><br><br><br>
                                        <a class="signuplink" href="#open-signin">Create Account</a>
                                    </div>   
                                </center>
                            </form>
                        </div>
                    </div> 
                    <!-- Signup Popup -->
                    <div id="open-signin" class="modal-window">
                        <div>
                            <a href="Home.php" title="Close" class="modal-close">Close</a>
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
                    // Login
                    echo '<a class="btn2" href="Signout.php">';
                    echo '<img class="userPic" src="Img/exit.svg" alt="signout">';
                    echo '</a>';
                }
            ?>
            </div>
        </div>
        <!-- Navigation Bar -->
        <div class="navigation">
            <a href="javascript:window.location.reload(true)" class="title">Profile Account</a>
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

        <div class="subcontainer">
            <div class="profile">
                <img src="Img/Profile-Female.png" alt="profile">
                <input class="username" type="text" name="username" id="" value="<?php echo $username?>">
                <p class="usname">Username</p>
                <hr class="vertical">
                <div class="stats">
                    <p class="grid">Cart Items</p>
                    <p class="grid"><?php echo $result2['total'];?></p>
                    <p class="grid">Cart Amount</p>
                    <p class="grid"><?php if($result3['ptotal']==0){
                                        echo "&#8369;0";            
                                        }else{
                                        echo "&#8369;".$result3['ptotal'];}?></p>
                </div>
            </div>
            <div class="sideprofile">
                <div class="nav">
                    <a id="acc" onclick="myAccount()" class="account">Account Settings</a>  <!--  Update ng profile-->
                    <a onclick="myOrder()" class="pending">Pending Order</a>     <!--  Ung mga naka reserve na pero d pa naapprove ng admin -->
                    <a onclick="myHistory()" class="history">Order History</a>     <!--  Order na na resive na. na pickup na-->
                    <a onclick="myNotification()" class="notification">Notification</a>      <!--  Ung sms-->
                </div>
                <div id="account">
                    <hr class="accunder">
                        <label class="fname" for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" value="<?php echo $FNAME;?>">

                        <label class="lname" for="lastname">Last Name</label>                        
                            <input type="text" name="lastname" id="lastname" value="<?php echo $LNAME;?>">

                        <label class="phone" for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo $CONTACT;?>">

                        <label class="email" for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="<?php echo $EMAIL;?>"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">  
                        
                            <label class="address" for="address">Address</label>
                            <input type="text" name="address" id="address" value="<?php echo $ADDRESS;?>">

                        <label class="city" for="city">City</label>
                            <input type="text" name="city" id="city" value="<?php echo $CITY;?>">
                            
                        <label class="password" for="password">New Password</label>
                            <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">

                        <label class="password2" for="password2">Confirm Password</label>
                            <input type="password" name="password2" id="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        <hr class="line1">
                        <input class="submitbtn" type="submit" value="Update">
                </div>
                <div id="pending">
                    <hr class="penunder">

                </div>
                <div id="history">

                </div>
                <div id="notification">

                </div>
                
                <script src="Js/Profile.js"></script>
            </div>
        </div>








                <a href="cpass.php">Change Password</a>
                <a href="purchase.php">My Purchase</a>

</div>            
</body>
</html>
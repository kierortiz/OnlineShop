<?php
    // Initialize the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/Navigation.css">
    <link rel="stylesheet" href="CSS/Home-Style.css">
    <title>Home || Blessed4'J Minimart</title>
    <style>
        body{
                background-color: #157eff;
                background-image: url(Img/Confetti-Doodles.svg);
                background-attachment: fixed;
                background-size: cover;
        }
    </style>
</head>
<body>
    <!-- <div id=body><img class="body" src="Img/Confetti-Doodles.svg" alt=""></div> -->
    <div class="container">
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
                                        <input class="username" type="text" name="username" required autofocus>
                                        <label class="user" >Username</label>
                                        <span class="span1"></span>

                                        <input class="password" type= "password" name="password" required>
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
            <a href="javascript:window.location.reload(true)" class="title">Blessed4J's Minimart</a>
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
               <form action="Home.php" method="POST" class="design">
                    <input type="search" name="search" class="search-box" placeholder="Search...">
                    <!-- <button type="reset" class="close-icon"></button> -->
                    <button type="submit" id=searchbtn class="searchbtn" name="searchbtn">
                        <img id=img src="Img/search.svg" alt="search"/>
                    </button>
               </form>
        </div>
        <?php 
                include "db_conn.php";

                if(isset($_POST['searchbtn'])){

                    $search=$_POST['search'];
                    $view="SELECT * FROM tbl_product where PROD_NAME LIKE '%$search%' OR PROD_CAT LIKE '%$search%'";
                    
                    //echo"<a class=cancelbtn href=Home.php><img id=img2 src=Img/close.svg alt=cancel></a>";
                    echo"<a class=cancelbtn href=Home.php>Cancel</a>";
                    
                }
                else if(isset($_POST['filter'])){
                    $min=$_POST['min'];
                    $max=$_POST['max'];
                    $view="SELECT * FROM tbl_product where PROD_PRICE BETWEEN '$min' AND '$max'";
                }        
                else{
                    $view="SELECT * FROM tbl_product";
                }
                    $result=$conn->query($view);                 
                    if ($result->num_rows>0){
                        // echo "<center><a 'href=home.php><h1>PRODUCTS</h1></a>";
                        // echo "<table border= 1 cellpadding=20>";
                        // echo "<th> PRODUCT NAME ";
                        // echo "<th> PRODUCT QUANTITY";
                        // echo "<th> PRODUCT PRICE "; 
                        // echo "<th> PRODUCT DESCRIPTION ";
                        // echo "<th COLSPA'N =2> ACTION";
                            echo '<div class="row">';
                        while ($row= $result ->fetch_assoc()){
                            $id=$row['PROD_ID'];
                            $quantity=$row['PROD_QUANTITY'];
                            $quan=1;
                            echo'<div class="column">';
                            echo    '<div class="card">';
                            echo"<form method=POST action=addcart.php>";
                            echo        '<img src="data:image/jpeg;base64,'.base64_encode( $row['PROD_IMG'] ).'" alt=""/>'; 
                            echo        '<p class="prodName">'.$row['PROD_NAME'];
                            echo        '<p class="prodDesc">'.$row['PROD_VARIANT'];
                            echo        '<p class="prodPrice">&#8369;'.$row['PROD_PRICE'];
                            echo        '<p class="prodQuan">Quantity:&nbsp<input type=number name="quan" min="1" value=1></p>';
                            // echo        '<div class="productPicture">';
                            echo"<input type=hidden name=id value=$id>";
                            echo"<input class='cart' title=add-to-cart type=submit name=+cart value=''><img class=img src=Img/add-to-cart.svg>";
                            echo"<input class='buy' title=buy-now type=submit name=buy value=''><img class=img2 src=Img/cash-payment.svg></form>";
                            echo'</div>';
                            echo'</div>';
                            //echo" <td> <a href=addcart.php?id=".$row['PROD_ID'].";>+CART</a>";
                            //echo" <td> <a href=buy.php?id=".$row['PROD_ID'].";>BUY</a>";
                        }
                    }
                    else{
                        echo "<p class=note>No Item Found!</p>";
                    }
                ?>    
        
    </div>
</body>
</html>



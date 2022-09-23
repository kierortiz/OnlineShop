<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //When Not Login Return to this Page
    header("refresh:0; Home.php#open-login");    
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/Cart.css">
    <link rel="stylesheet" href="CSS/Navigation.css">
    <title>Shopping Cart || Blessed4'J Minimart</title>
</head>
<body>
    <div class="container">
        <div class="blue"></div>
        <div class="diamond"></div>
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
            <a href="AboutUs.php" class="title">Blessed4'J Minimart</a>      
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
        <?php
            include "db_conn.php";
            $currentUser = $_SESSION['username'];
            //Fetch data from data base on current user
            $view="SELECT * FROM tbl_cart WHERE CART_USER = '$currentUser' ";
            $result=$conn->query($view);
                if ($result->num_rows>0)
                {
                    //echo "<center><a href=cart.php><h1>TO BUY</h1></a>"
                    echo"<div class=header>
                            <p class=grid-items>Product Details</p>
                            <p class=grid-items>Quantity</p>
                            <p class=grid-items>Price</p>
                            <p class=grid-items>Total</p>
                         </div> ";
                    echo'<div class="row">';                    
                    echo" <form method=POST action=buyordel.php>";            
                        $totalqty=0;
                        $totalprice=0;
                    while ($row= $result ->fetch_assoc())
                    {    
                        $id=$row['CART_ID'];
                        $id2=$row['CART_PID'];
                        $cprodname=$row['CART_PRODUCTNAME'];
                        $cquan=$row['CART_QUAN'];
                        $price=$row['CART_PRICE'];
                        $cvar=$row['CART_VARIANT'];
                        $total=$cquan*$price;
                        $totalprice+=$total;
                        $totalqty+=$cquan;
                        $totalten=$totalprice*.10;
                        // $categ=$row['CART_CATEGORY'];

                        echo    '<div class="card">';
                        echo"<input type=hidden name=id value=$id>";
                        $query = "SELECT * FROM tbl_product WHERE PROD_ID=$id2";  
                        $res = mysqli_query($conn, $query);  
                        while($row2 = mysqli_fetch_array($res))
                        {
                            $cat=$row2['PROD_CAT'];
                            echo"<div class=card1>";
                            echo'<img class=img src="data:image/jpeg;base64,'.base64_encode( $row2['PROD_IMG'] ).'" name=img value="data:image/jpeg;base64,'.base64_encode( $row2['PROD_IMG'] ).'"/>';
                            echo"   <p class='prod1'>$cprodname</p>
                                    <b>Description</b>
                                    <p class='prod2'>&nbsp$cvar</p>
                                    <b>Category</b>
                                    <p class='prod3'>&nbsp$cat</p></div>";
                        }
                        echo" <div class='card2'><input type=number name=qty class=qty min=1 value=$cquan /></div>";
                        //         var parent = $(this).closest('form');
                        //         var targetInput = parent.find('input[name="' + $(this).attr('field') + '"]');
                        //         function increaseValue(id) 
                        //         {
                        //             var value = parseInt(document.getElementById('number').value, 10);
                        //             value = isNaN(value) ? 0 : value;
                        //             value++;
                        //             document.getElementById('number').value = value;
                        //         }
                        //         function decreaseValue(id) {
                        //             var value = parseInt(document.getElementById('number').value, 10);
                        //             value = isNaN(value) ? 0 : value;
                        //             value < 1 ? value = 1 : '';
                        //             value--;
                        //             document.getElementById('number').value = value;
                        //         }
                        echo" <p class='card3'>&#8369;$price Php</p>";
                        echo"<div class=card4><P class=note1>&#8369;$total Php</p>"; 
                        echo"<input type='checkbox' checked class=check name='buys[]' value='$id' ><label for=$id>Select to</label><p class=note>Buy or Remove</div>";
                        echo'</div>';
                        //echo" <td> <a href=addcart.php?id=".$row['PROD_ID'].";>+CART</a>";
                        //echo" <td> <a href=buy.php?id=".$row['PROD_ID'].";>BUY</a>";
                    }
                    echo"</div>";
                    echo"<div class=side>";
                    echo"<h1>Summary</h1>
                            <center><hr class=line1></hr></center>
                            <div class=quantity><p>Total Items</p><p>$totalqty</p><p>&#8369;$totalprice Php</p></div>
                            <div class=quantity2><p>10% Downpayment</p><p>&#8369;$totalten Php</p></div>
                            <div class=quantity3><p>Minimum of &#8369;50 Php of your Total Downpayment to Reserve your items.</p></div>";
                    echo"<center><hr class=line2></hr></center>
                         <div class=buttons><input class='buy' type=submit name=buy value=Reserve>
                            <input class='remove' type=submit name=del value=Remove></div></form>";                            
                        //para makuha quantity select from where quantity= id or something
                }   
        ?>     
    </div>
</body>
</html>
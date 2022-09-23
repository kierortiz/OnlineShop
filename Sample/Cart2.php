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
<html>
    <head><title>Cart</title></head>
    <body>
        <center>
            CART
            <div>
                
            <a href="home.php">HOME</a>
            </div>
        </center>
    </body>
</html>

<?php
include "db_conn.php";
$currentUser = $_SESSION['username'];
//Fetch data from data base on current user
  $view="SELECT * FROM tbl_cart WHERE CART_USER = '$currentUser' ";

  $result=$conn->query($view);

                    
    if ($result->num_rows>0)
    {
        //echo "<center><a href=cart.php><h1>TO BUY</h1></a>";
        echo "<table border= 1 cellpadding=20>";

        echo "<th> PRODUCT NAME ";
        echo "<th> PRODUCT QUANTITY";
        echo "<th> PRODUCT PRICE "; 
        echo "<th> PRODUCT DESCRIPTION ";
        echo" <form method=POST action=buyordel.php>";

       
                    
                while ($row= $result ->fetch_assoc())
                {
                    $id=$row['CART_ID'];
                    $cprodname=$row['CART_PRODUCTNAME'];
                    $cquan=$row['CART_QUAN'];
                    $price=$row['CART_PRICE'];
                    $cvar=$row['CART_VARIANT'];
                    
                echo" <tr>";
               // echo"<input type=hidden name=id value=$id>";
                echo" <td> $cprodname";
                echo" <td> $cquan";
                echo" <td> $price";
                echo" <td>$cvar "; 
                echo"<td><input type='checkbox' name='buys[]' value='$id' >buy</input></td>";
                
            
            
                //echo" <td> <a href=addcart.php?id=".$row['PROD_ID'].";>+CART</a>";
                //echo" <td> <a href=buy.php?id=".$row['PROD_ID'].";>BUY</a>";
                }
                echo"<input type=submit name=buy value=buy>";
                echo"<input type=submit name=del value=delete></form>";
                
            //para makuha quantity select from where quantity= id or something

        }
    

    
    
?>



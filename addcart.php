
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("refresh:0; Home.php#open-login");
    exit;
}
$usercart = $_SESSION["username"];
include "db_conn.php";

if(isset($_POST['+cart']))
{    
    $id=$_POST['id'];
    $quan=$_POST['quan'];
    //$image=$_POST['img'];
    $up="SELECT * FROM tbl_product WHERE PROD_ID ='$id'";
    $result=$conn->query($up);
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_array($result);
        $id1=$row['PROD_ID'];
        $newcprod=$row['PROD_NAME'];
        $newcquant=$row['PROD_QUANTITY'];
        $newcprice=$row['PROD_PRICE'];
        $newcvar=$row['PROD_VARIANT'];
        
        $tot=$quan*$newcprice;
        // echo $tot;
        $up1="SELECT * FROM tbl_cart WHERE CART_PID ='$id' AND CART_USER= '$usercart'";
        $result1=$conn->query($up1);
        $row1 = $result1->fetch_array();
            $cid=$row1['CART_ID'];
            $cpdname=$row1['CART_PRODUCTNAME'];
            $cquant=$row1['CART_QUAN'];
            
        if($newcprod!=$cpdname)
        {   
            $ins="INSERT INTO tbl_cart(CART_PID,CART_PRODUCTNAME,CART_VARIANT,CART_QUAN,CART_PRICE,CART_COMPPRICE,CART_STATUS,CART_USER)
            values($id1,'$newcprod','$newcvar',$quan,$newcprice,$tot,'CART','$usercart')";
            $result=$conn->query($ins);
            if ($result==true)
            {
                ?>
                <script>
                alert("Item added to Cart");
                </script>
                <?php 
            header("refresh:10; Home.php");
            }    
        }else
        {
            $newquan=$quan+$cquant;
            $ins1="UPDATE tbl_cart SET CART_QUAN='$newquan' WHERE CART_ID='$cid' AND CART_USER='$usercart'";
            $res=$conn->query($ins1);
            if ($result==true)
            {
                ?>
                <script>
                alert("Item addeds to Cart");
                </script>
                <?php 
            header("refresh:0; Home.php");
            }
        }
    }
}

if(isset($_POST['buy']))
{

    $id=$_POST['id'];
    $quan=$_POST['quan'];
    // echo $quan;
    $up="SELECT * FROM tbl_product WHERE PROD_ID ='$id'";
    $userSession = $_SESSION['username'];
    $checkuser="SELECT * FROM tbl_account WHERE ACC_USER ='$userSession'";
    // echo $userSession;
    $newresult=$conn->query($checkuser);
    $found = mysqli_fetch_array($newresult);
    $userid = $found['ACC_ID'];
    $Firstname = $found['ACC_FNAME'];
    $Lastname = $found['ACC_LNAME'];
    $fullname = $Firstname . " $Lastname";

    $result=$conn->query($up);
    //display summarry
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_array($result);
        $id1=$row['PROD_ID'];
        $newcprod=$row['PROD_NAME'];
        $newcquant=$row['PROD_QUANTITY'];
        $newcprice=$row['PROD_PRICE'];
        $newcvar=$row['PROD_VARIANT'];
        $totalp=$newcprice*$quan;
        $tenp= $totalp*.10;
        $TD = date("M d, Y  h:i:s a");//TODAY
        $day = date("d")+5;
        $limit = date("M $day, Y");//Available until
        if ($totalp<=499)
        {
            ?>
            <script>
            alert("Reservation minimum is 500php, Please add more!");
            </script>
            <?php 
          header("refresh:0; home.php");
        }
        else{
        echo '<html lang="en">';
        echo '<head>';
        echo '<link rel="stylesheet" href="CSS/Buy.css">';
        echo '<body>';
        echo "<form method=POST action=addcart.php>";
        echo '<div class="container">';
        echo '<div class="blue"></div>';
        echo '<div class="diamond"></div>';
        echo '<div class="subcontainer">';
        echo '  <div class="leftcorner">';
        echo "      <input type=hidden name='id' value= '$id1'>";//ID NG PRODUCT
        echo "      <input type=hidden name='fullname' value='$fullname'>";
        echo "      <p class=title><img class=usericon src=Img/userIcon.svg>&nbsp&nbspReciept for</p> <p class=name>".$fullname;  
        echo "      <center><hr class=line1></center>";
        echo "      <p class=Amount><img src=Img/wallet.svg>&nbsp&nbspAmount:</p>";
        echo "      <input type=hidden name='totalp' value= '$totalp'>
                    <p class=totalprice>&#8369;$totalp.00 Php</p>"; 
        echo "      <center><hr class=line2></center>";        
        echo "      <p class=Datelimit><img src=Img/calendar.svg>&nbsp&nbspAvailable Until:</p>";
        echo "      <input type=hidden name='limit' value= '$limit'>
                    <p class=limit>$limit</p>"; 
        echo "      <center><hr class=line3></center>";      
        echo "      <p class=Companyname><img src=Img/star.svg>&nbsp&nbspMerchant:</p>";
        echo "      <p class=company>Blessed4J's Minimart</p>"; 
        echo '  </div>';
        echo '  <div class="rightcorner">';
        echo '      <a href="Home.php" class="back"><img class=backicon src=Img/back.svg></a>';
        echo "      <img class=LOGO src=Img/Gcash.png>";
        echo "      <p class=invoce><input type=hidden name=invoice value=$userid>Invoice ID: $userid"; 
        echo "      <p class=date>$TD";//time date
        echo "      <input type=hidden name='newcprod' value= '$newcprod'>";
        echo "      <p class=pdet>Payment Details";
        echo "      <div class=grid>";
        echo "          <p class=grid-item1>Description</p> ";
        echo "          <p class=grid-item1>Unit Price</p>"; 
        echo "          <p class=grid-item1>Qty</p> ";
        echo "          <p class=grid-item1>Amount</p> ";
        echo "          <p class=grid-item>$newcprod $newcvar</p>";
        echo "          <p class=grid-item>&#8369;$newcprice.00 Php</p> ";                   
        echo "          <p class=grid-item>$quan</p>                  ";  
        echo "          <p class=grid-item>&#8369;$totalp.00 Php</p>";
        echo "      </div>";
        echo "      <input type=submit class=reservebtn name='continue' value='RESERVE'>";

        echo "      <p class=pdet2>Payment Details</p>";
        echo "      <p class=pdet3>Pay using Gcash, please use this when paying:";
        echo "      <p class=pdet4>GCASH NUMBER: 0987129847";
        echo "      <p class=choice>Payment Option</p>";
        echo "      <div class=bottom2><p class=amt2>Amount<input type=radio required name=down value=value1></p><p class=amtnum2>&#8369;$totalp Php</p>
                    <p class=dpay2>Downpayment<input type=radio required name=down value=value2></p><p class=dpaynum2>&#8369;$tenp Php</p></div>";
        echo "      <input type=hidden name='tenp' value= '$tenp'>";
        //                You can pay 10% (<input type=radio required=required name=down value=value1><b> &#8369 $tenp Php</b>) of you total and pay the rest at pickup or pay in full (<input type=radio required=required name=down value=value2><b> &#8369 $totalp Php</b>) you'll recieve SMS once payment is recieve";
        //echo "      <p class=note>It may take a few momments for this transaction to appear in your account."; 
        echo "      <input type=hidden name='newcvar' value= '$newcvar'>"; //variety
        echo "      <input type=hidden name='quan' value= '$quan'>"; //quantity
        echo "      <input type=hidden name='newcprice' value= '$newcprice'>"; //original price
        // echo "      <h3> DownPayment<br> <p></h2> $tenp.00-$totalp.00</p>"; 
        echo "      </form>";
        echo '  </div>';
        echo '</div>';
    }
    }
    
        
  }
  if(isset($_POST['continue']))
  {
    $id=$_POST['id'];
    $invoice=$_POST['invoice'];
    $name=$_POST['fullname'];
    $limit=$_POST['limit'];
    $newcprod=$_POST['newcprod'];
    $newcvar=$_POST['newcvar'];
    $quan=$_POST['quan'];
    $newcprice=$_POST['newcprice'];
    $totalp=$_POST['totalp'];
    $tenp=$_POST['tenp'];
    $detail = $newcprod . " $newcvar";
    $radioVal = $_POST["down"];
    if($radioVal == "value1")
    {
        $tenp= $totalp;
        $totalpay = 0;
    }
    else if ($radioVal == "value2")
    {
        $tenp= $totalp*.10;
        $totalpay = $totalp - $tenp;
    }
//condition para pag nag refresh d maduduplicate ung insert
    $ins="INSERT INTO tbl_order(ORDER_INVOICE, ORDER_NAME, ORDER_DETAILS, ORDER_QUANTITY, ORDER_TOTAL, ORDER_PAYMENT, ORDER_TOTALPRICE, ORDER_VALIDITY, ORDER_STATUS) 
                          VALUES ($invoice,'$name','$detail',$quan,$totalp,$tenp,$totalpay,'$limit','PENDING')";
    $result=$conn->query($ins);
             if ($result==true)
             {
                $TD = date("M d, Y  h:i:s a");//TODAY
                echo '<html lang="en">';
                echo '<head>';
                echo '<link rel="stylesheet" href="CSS/Buy.css">';
                echo '<body>';
                echo "<div class=ncontainer>";
                echo '<div class="blue"></div>';
                echo '<div class="diamond"></div>';
                echo "<div class=notice>";
                echo '  <div class="leftcorner">';
                echo "      <p class=comname>Blessed4J's";  
                echo "      <p class=about>Detail of Your Reservation";
                echo "      <p class=helo>Hello</p>";
                echo "      <p class=detname>$name</p>";  
                echo "      <p class=detdet>You sent a payment of &#8369;$tenp Php to Blessed4J's, processed by Gcash</p>";   
                echo "      <div class=grid-container>
                            <p class=items>Merchant</p>
                            <p class=items>Instruction</p>
                                  <p class=items>Blessed4J's, processed by Gcash</p>
                                  <p class=items>Pickup your item before $limit show this as a proof of reservation</p>
                            <p class=items>Contact</p>
                            <p class=items>Location</p>
                                  <p class=items>Number: 0987129847 or <a class=link href=ContactUs.php>Visit Here</a></p>
                                  <p class=items>Stall 42, 2nd Flr
                                  City Mall of Antipolo, Olalia Road, Brgy. Sta Cruz, Antipolo City
                                  </p>
                            </div>";
                echo "      <p class=question>Question? Go to Help Center at<a href=ContactUs.php>ContactUs.</a></p>";
                echo '  </div>';

                echo '  <div class="rightcorner">';
                echo '      <a href="Home.php" class="back"><img class=backicon src=Img/close.svg></a>';
                echo "      <img class=LOGO src=Img/Gcash.png>";
                echo "      <p class=date>$TD";//time date
                echo "      <center><hr class=line4></center>";    
                echo    "<p class=notice1>Your Item is Successfully Reserve!";
                echo    "<p class=notice2>Once your Payment is confirmed you'll recieve an SMS.</p>";
                echo    "<p class=notice3>It may take a few momments for this transaction to appear in your account.";
                echo "      <center><hr class=line7></center>";
                echo "      <p class=invoce>Invoice ID: $invoice"; 
                echo '  </div>';
                header("refresh:5; Home.php");
             }
   
}        
?>

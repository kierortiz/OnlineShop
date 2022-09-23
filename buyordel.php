
<?php
// Initialize the session
session_start();
$costumerUser = $_SESSION['username'];
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("refresh:0; Home.php#open-login");
    exit;
}

include "db_conn.php"; 
if(isset($_POST['buy']))
{
    $c="check";
    if(!empty($_POST['buys'])){//LOOP
        // Loop to store and display values of individual checked checkbox.
        foreach($_POST['buys'] as $id){
            //CHECKBOX NG NACART
            
            $ins1="UPDATE tbl_cart SET CART_OP='$c' WHERE CART_ID='$id' AND CART_USER='$costumerUser'";//session where cart id =id and session and user =session            
            $res=$conn->query($ins1);
            // if($res==true){echo"nice";}else{echo"not nice";}
        }
    }
    $checkuser="SELECT * FROM tbl_account WHERE ACC_USER ='$costumerUser'";
    // echo $userSession;
    $newresult=$conn->query($checkuser);
    $found = mysqli_fetch_array($newresult);
    $userid = $found['ACC_ID'];
    $Firstname = $found['ACC_FNAME'];
    $Lastname = $found['ACC_LNAME'];
    $fullname = $Firstname ." $Lastname";
    $TD = date("M d, Y  h:i:s a");//TODAY
    $day = date("d")+5;
    $limit = date("M $day, Y");//Available until

    $view="SELECT * FROM tbl_cart WHERE CART_OP='check' AND CART_USER='$costumerUser'";//session where cart op=check  and cart_user = user
    $result=$conn->query($view);
    $result2=$conn->query($view);
    //display summarry
    if (!empty($result) && $result->num_rows > 0)
    {
        if ($found2= $result2 ->fetch_assoc())
        {
            $id=$found2['CART_ID'];
            $pid=$found2['CART_PID'];
            $cprodname=$found2['CART_PRODUCTNAME'];
            $cquan=$found2['CART_QUAN'];
            $price=$found2['CART_PRICE'];
            $cvar=$found2['CART_VARIANT'];
            $totalp=$price*$cquan;
        }
        if ($totalp<=499)
        {
            ?>
            <script>
            alert("Reservation minimum is 500php, please add more");
            </script>   
            <?php 
          header("refresh:0; cart.php");
        }
        else{
        $qry = "SELECT SUM(CART_COMPPRICE) AS tot FROM tbl_cart WHERE CART_OP ='check'";
        $res = $conn->query($qry)or die($conn->error);
        $total = 0;
        $rec = $res->fetch_assoc();
        $total = $rec['tot'];
        echo '<html lang="en">';
        echo '<head>';
        echo '<link rel="stylesheet" href="CSS/Buy.css">';
        echo '<body>';
        echo"<form method=POST action=buyordel.php>";
        echo '<div class="container">';
        echo '<div class="blue"></div>';
        echo '<div class="diamond"></div>';
        echo '<div class="subcontainer2">';
        echo '  <div class="leftcorner2">';
        echo "      <input type=hidden name='fullname' value='$fullname'>";
        echo "      <p class=title2><img class=usericon2 src=Img/userIcon.svg>&nbsp&nbspReciept for</p> <p class=name2>".$fullname;  
        echo "      <center><hr class=line1></center>";
        echo "      <p class=Amount2><img src=Img/wallet.svg>&nbsp&nbspAmount:</p>";
        echo "      <p class=totalprice2>&#8369;$total.00 Php</p>"; 
        echo "      <center><hr class=line2></center>";        
        echo "      <p class=Datelimit3><img src=Img/calendar.svg>&nbsp&nbspAvailable Until:</p>";
        echo "      <input type=hidden name='limit' value= '$limit'>
                    <p class=limit3>$limit</p>"; 
        echo "      <center><hr class=line3></center>";      
        echo "      <p class=Companyname2><img src=Img/star.svg>&nbsp&nbspMerchant:</p>";
        echo "      <p class=company2>Blessed4J's Minimart</p>";
        echo '  </div>';
        echo '  <div class="rightcorner2">';
        echo '      <button class=back name=back><img class=backicon src=Img/back.svg></button></a>';
        echo "      <img class=LOGO2 src=Img/Gcash.png>";
        echo "      <p class=dt>$TD";
        echo "      <input type=hidden name=invoice value=$userid>";
        echo "      <p class=inv>Invoive ID: $userid";
        echo "      <p class=pd>Payment Details</p>";
        echo "      <input class='buy' type=submit name=continue value='RESERVE'>";
        $qry = "SELECT SUM(CART_COMPPRICE) AS tot FROM tbl_cart WHERE CART_OP ='check'";
                        $res = $conn->query($qry)or die($conn->error);
                        $total = 0;
                        $rec = $res->fetch_assoc();
                        $total = $rec['tot'];
                        $tenp=$total * .10;
                    echo "<p class=option>Payment Option";
                    echo "<p class=option2>Payment Details";
                    echo "<p class=option3>Pay using Gcash, please use this when paying:";
                    echo "<p class=option4>GCASH NUMBER: 0987129847";
                    echo "<div class=bottom>";
                    echo "<input type=hidden name='total' value='$total' >
                          <input type=hidden name='tenp' value='$tenp'>";
                    echo "<p class=amt>Amount<input type=radio required checked name='pay' value='$total' ></p><p class=amtnum>&#8369;$total Php</p>
                          <p class=dpay>Downpayment<input type=radio required name='pay' value='$tenp'></p><p class=dpaynum>&#8369;$tenp Php</p></div>";

        echo "      <center><hr class=bordertop>";
        echo "      <hr class=borderbottom></center>";
        echo "      <div class=table>";
        echo "          <table>";
        echo "          <th>Description</th>";
        echo "          <th>Unit Price</th>";
        echo "          <th>Qty</th>";
        echo "          <th>Amount</th>";
                    while ($row= $result ->fetch_assoc())
                    {
                                $id=$row['CART_ID'];
                                $pid=$row['CART_PID'];
                                $cprodname=$row['CART_PRODUCTNAME'];
                                $cquan=$row['CART_QUAN'];
                                $price=$row['CART_PRICE'];
                                $cvar=$row['CART_VARIANT'];
                                $totalp=$price*$cquan;

                                echo "<input type=hidden name='pid[]' value='$pid'>";
                                echo "<input type=hidden name='id[]' value= '$id'>";
                                echo "<input type=hidden name='newcvar' value= '$cvar'>";
                                echo "<input type=hidden name='newcprod' value= '$cprodname'>";
                                echo "<input type=hidden name='newcprice' value= '$price'>";
                                echo "<input type=hidden name='quan' value= '$cquan'>";
                                echo "<input type=hidden name='totalp' value= '$totalp'>";
                                
                                echo "<tr>";                  
                                echo "<td>$cprodname $cvar";
                                echo "<td>&#8369;$price.00 Php"; 
                                echo "<td>$cquan";
                                echo "<td>&#8369;$totalp.00 Php";
                                echo "</tr>";         
                        }            
                        }
        echo '      </div>';// table close
                       // echo"<input type=submit name='back' value='back'>";
        echo"</form>";
        echo '  </div>';
        
        echo'</div>';
      
        
                        
                        
                        
    }
    else{
        ?>
            <script>
                alert("No Item Selected");
            </script>
        <?php
        header("refresh:0; Cart.php");
    }
}
if(isset($_POST['back']))
 {
    foreach($_POST['id'] as $id)
    {
        $space=""; 
        $ins1="UPDATE tbl_cart SET CART_OP='$space' WHERE CART_ID='$id' AND CART_USER='$costumerUser'";//where cart op=check  and session
        $res=$conn->query($ins1);
        if($res==true){header("refresh:0; Cart.php");}else{echo"not nice";}
    }
 }

    if(isset($_POST['del']))
    {
       foreach($_POST['buys'] as $id)
        {
           $space=""; 
           $del= "DELETE FROM tbl_cart WHERE CART_ID = '$id' AND CART_USER='$costumerUser'";//where cart op=check  and session
           $res=$conn->query($del);
           if($res==true){header("location: Cart.php");}else{echo"not nice";}
        }
    } 



///////////////////RESERVE
 if(isset($_POST['continue']))
 {   
    $total=$_POST['total'];
    $invoice=$_POST['invoice'];
    $tenp=$_POST['tenp'];
    $radioVal = $_POST["pay"];
    $TD = date("M d, Y  h:i:s a");//TODAY
    $day = date("d")+5;
    $limit = date("M $day, Y");//Available until
    $name=$_POST['fullname'];
        if($radioVal == "$total")
        {
            $tenp = $total;
            $totalp = 0;//balance
        }
        else if ($radioVal == "$tenp")
        {
            $tenp= $total*.10;
            $totalp = $total - $tenp;//balance
        }
         
         

         foreach($_POST['id'] as $id){
          $up1="SELECT * FROM tbl_cart WHERE CART_ID ='$id' AND CART_USER='$costumerUser'"; //where cart op=check  and session
          $result1=$conn->query($up1)or die($conn2->error);
         
         //display summarry
          if($result1->num_rows>0)
          {            
            $row= $result1 ->fetch_assoc();
            $newcprod=$row['CART_PRODUCTNAME'];
            $pid=$row['CART_PID'];
            $quan=$row['CART_QUAN'];
            $newcprice=$row['CART_PRICE'];
            $newcvar=$row['CART_VARIANT'];
            // echo "<center><h1>PRODUCT SUMMARY</h1>";
            // echo "<h3> Product Name</h3> <p>$newcprod</p>";
            // echo "<h3> Product Description </h3> <p>$newcvar</p>";
            // echo "<h3> Product Quantity</h3> <p>$quan</p>";
            // echo "<h3> Total</h3> <p>$totalp</p>";
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

               $ins2="INSERT INTO tbl_res(RES_PROD_ID,RES_PRODNAME,RES_PRODQUAN,RES_PRODVAR,RES_PRODPRICE,RES_PRODOWN,RES_PRODTOTAL,RES_PRODSTAT,RES_USER)
               values($pid,'$newcprod',$quan,'$newcvar',$newcprice,$tenp,$totalp,'PENDING','$costumerUser')";//where cart op=check  and session/ insert din sa cart_user $user
               $result2=$conn->query($ins2) or die($conn->error);
               ////////////////////////////////////////////////////////////DELETE
               $del= "DELETE FROM tbl_cart WHERE CART_ID = '$id' AND CART_USER='$costumerUser'";//where cart op=check  and session user
               
               $result3=$conn->query($del) or die($conn->error);
               if ($result2==false && $result3==false)
              {
               echo"somethings wrong i can feel it";   
              }
            }
        
    }


}


?>
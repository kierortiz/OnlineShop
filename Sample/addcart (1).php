<?php
include "db_conn.php";

if(isset($_POST['+cart']))
{
$id=$_POST['id'];
$quan=$_POST['quan'];
$up="SELECT * FROM tbl_product WHERE PROD_ID ='$id'";
$result=$conn->query($up);
if($result->num_rows>0){
    $row = mysqli_fetch_array($result);
    $id1=$row['PROD_ID'];
    $newcprod=$row['PROD_NAME'];
    $newcquant=$row['PROD_QUANTITY'];
	$newcprice=$row['PROD_PRICE'];
    $newcvar=$row['PROD_VARIANT'];
    $tot=$quan*$newcprice;
        $ins="INSERT INTO tbl_cart(CART_PID,CART_PRODUCTNAME,CART_VARIANT,CART_QUAN,CART_PRICE,CART_COMPPRICE,CART_STATUS)
        values($id1,'$newcprod','$newcvar',$quan,$newcprice,$tot,'CART')";
        $result=$conn->query($ins);
        if ($result==true)
        {
             ?>
             <script>
             alert("item added to cart");
             </script>
             <?php 
           header("refresh:0; home.php");
        }
        else{
            
        }
    }
    else
    {
        echo "0 results";
    }
}



if(isset($_POST['buy']))
{

    $id=$_POST['id'];
    $quan=$_POST['quan'];
    $up="SELECT * FROM tbl_product WHERE PROD_ID ='$id'";
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
        echo "<div><center><br><h2>PAYMENT INFO</h2></a>";
     
        echo" <form method=POST action=addcart.php>";
        echo  "<input type=hidden name='id' value= '$id1'>";
        echo "</center> GCASH NUMBER #987129847 <br>AFTER YOU CLICK RESERVE PLEASE <br>WAIT FOR RECEIPT VIA TXT MSG"; 
        echo   "<center><h3>CUSTOMER NAME<br></h2> <p>juan dela cruz</p>";  
        echo "<input type=hidden name='newcprod' value= '$newcprod'><h3> PRODUCT NAME<br></h2> <p>$newcprod</p>";
        echo "<input type=hidden name='newcvar' value= '$newcvar'><h3> PRODUCT DESCRIPTION<br></h2> <p>$newcvar </p>";
        echo "<input type=hidden name='quan' value= '$quan'><h3> PRODUCT QUANTITY<br></h2> <p>$quan</p>";
        echo "<input type=hidden name='newcprice' value= '$newcprice'><h3> PRODUCT PRICE<br> <p></h2> $newcprice.00</p>"; 
        echo "<input type=hidden name='totalp' value= '$totalp'><h3> TOTAL PRICE<br> <p></h2> $totalp.00</p>"; 
        echo "<input type=hidden name='tenp' value= '$tenp'><h3> DownPayment<br> <p></h2> $tenp.00-$totalp.00</p>"; 
        echo" <input type=submit name='continue' value='RESERVE'></form>";
    }
    
        
  }
  if(isset($_POST['continue']))
            {
                    $id=$_POST['id'];
                    $newcprod=$_POST['newcprod'];
                    $newcvar=$_POST['newcvar'];
                    $quan=$_POST['quan'];
                    $newcprice=$_POST['newcprice'];
                    $totalp=$_POST['totalp'];
                    $tenp=$_POST['tenp'];
                    $up="SELECT * FROM tbl_product WHERE PROD_ID ='$id'";
                    $result=$conn->query($up);
                    //display summarry
                    if($result->num_rows>0)
                    {

                        echo "<center><h1>PRODUCT SUMMARY</h1>";
                        echo "<h3> Product Name</h3> <p>$newcprod</p>";
                        echo "<h3> Product Description </h3> <p>$newcvar</p>";
                        echo "<h3> Product Quantity</h3> <p>$newcprod</p>";
                        echo "<h3> Total</h3> <p>$totalp</p>";

                        $ins="INSERT INTO tbl_res(RES_PROD_ID,RES_PRODNAME,RES_PRODQUAN,RES_PRODVAR,RES_PRODPRICE,RES_PRODOWN,RES_PRODTOTAL,RES_PRODSTAT)
                         values($id,'$newcprod',$quan,'$newcvar',$newcprice,$tenp,$totalp,'PENDING')";
                         $result=$conn->query($ins);
             if ($result==true)
             {
                 ?>
                <script>
                 alert("Item Reserved, Thank You for choosing us");
                </script>
                 <?php 
                 header("refresh:10; home.php");
             }
             else{
               
             }
                    } 
    
            
            }
        else
        {
            echo "";
        }
        
        


?>

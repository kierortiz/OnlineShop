<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
</head>
    <body>
        <form method=POST action="homealone.php">
            
            <a href="cart.php" style="margin-left:1385px;">CART</a>
            <a href="profile.php" >PROFILE</a>
            <a >BURGER</a><br>
            <a href="home.php" style="margin-left:1510px;">HOME</a><br>
            <a href="contact.php" style="margin-left:1481px;">CONTACT US</a><br>
            <a href="about.php" style="margin-left:1490px;">ABOUT US</a><br><br><br><br><br>
            <input type=text name="search" placeholder="search..." style="margin-left:1000px; width:350px; height:20px">
            <input type=submit name="search1" value="icon">
            <a style="margin-left:300px;">filter by price</a>
            <input type=text name="min" placeholder="min" style="margin-left:0px; width:55px; height:20px"  >-
            <input type=text name="max" placeholder="max" style="margin-left:0px; width:55px; height:20px">
            <input type=submit name="filter" value="filter">
            <br><br><br>

        </form>
    </body>
</html>

<?php 
include "db_conn.php";

if(isset($_POST['search1']))
{

    $search=$_POST['search'];
    $view="SELECT * FROM tbl_product where PROD_NAME LIKE '%$search%' OR PROD_CAT LIKE '%$search%'";
    
}
else if(isset($_POST['filter'])){
    $min=$_POST['min'];
    $max=$_POST['max'];
    $view="SELECT * FROM tbl_product where PROD_PRICE BETWEEN '$min' AND '$max'";
}
        else
        {
          $view="SELECT * FROM tbl_product";
        }
          $result=$conn->query($view);

                            
            if ($result->num_rows>0)
            {
                echo "<center><a href=home.php><h1>PRODUCTS</h1></a>";
                echo "<table border= 1 cellpadding=20>";

                echo "<th> PRODUCT NAME ";
                echo "<th> PRODUCT QUANTITY";
                echo "<th> PRODUCT PRICE "; 
                echo "<th> PRODUCT DESCRIPTION ";
        
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
                            $id=$row['PROD_ID'];
                            $quan=1;
                        echo" <tr>";
                        echo" <form method=POST action=addcart.php>";
                        echo" <td> ".$row['PROD_NAME'];
                        echo" <td> <input type=number name=quan value='2'>";
                        
                        echo" <td> ".$row['PROD_PRICE'];
                        echo" <td> ".$row['PROD_VARIANT']; 
                        echo"<input type=hidden name=id value=$id>";
                        echo"<td><input type=submit name=+cart value=+cart>";
                        echo"<td><input type=submit name=buy value=buy></form>";
                        
                        //echo" <td> <a href=addcart.php?id=".$row['PROD_ID'].";>+CART</a>";
                        //echo" <td> <a href=buy.php?id=".$row['PROD_ID'].";>BUY</a>";
                        }

                }
            

            else
            {
                echo "0 results";
            }
        

        //     //////////////////////////////////////////////////////FILTER BY

        // if(isset($_POST['filter']))
        // {
            
        //             $filter=$_POST['filter'];
        //             $view="SELECT * FROM tbl_product where PROD_PRICE LIKE '%$filter%' OR PROD_CAT LIKE '%$filter%'";
                    
        //         }
        //                 else
        //                 {
        //                 $view="SELECT * FROM tbl_product";
        //                 }
        //                 $result=$conn->query($view);

                                            
        //                     if ($result->num_rows>0)
        //                     {
        //                         echo "<center><a href=home.php><h1>PRODUCTS</h1></a>";
        //                         echo "<table border= 1 cellpadding=20>";

        //                         echo "<th> PRODUCT NAME ";
        //                         echo "<th> PRODUCT QUANTITY";
        //                         echo "<th> PRODUCT PRICE "; 
        //                         echo "<th> PRODUCT DESCRIPTION ";
                        
        //                         // echo "<th COLSPAN =2> ACTION";
                                            
        //                                 while ($row= $result ->fetch_assoc())
        //                                 {
        //                                     $id=$row['PROD_ID'];
        //                                     $quan=1;
        //                                 echo" <tr>";
        //                                 echo" <form method=POST action=addcart.php>";
        //                                 echo" <td> ".$row['PROD_NAME'];
        //                                 echo" <td> <input type=number name=quan value=$quan>";
                                        
        //                                 echo" <td> ".$row['PROD_PRICE'];
        //                                 echo" <td> ".$row['PROD_VARIANT']; 
        //                                 echo"<input type=hidden name=id value=$id>";
        //                                 echo"<td><input type=submit name=+cart value=+cart>";
        //                                 echo"<td><input type=submit name=buy value=buy></form>";
                                        
        //                                 //echo" <td> <a href=addcart.php?id=".$row['PROD_ID'].";>+CART</a>";
        //                                 //echo" <td> <a href=buy.php?id=".$row['PROD_ID'].";>BUY</a>";
        //                                 }

        //                         }
                            

        //                     else
        //                     {
        //                         echo "0 results";
        //                     }
                        


?>
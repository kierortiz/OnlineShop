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
// $sessionUSERNAME = $_SESSION["username"] = $user;
// $sessionNAME = $_SESSION["name"] = $uname;          
// $sessionPOSITION = $_SESSION["position"] = $uposition;   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Admin.css" type="text/Css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="Preview-Image.js" type="text/Javascript"> -->
    <title>Blessed4J's || Admin Inventory</title>
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
        <div class="inventory">
			<!--VIEW AND SEARCH FUNCTION START-->
            <form method=POST action=Admin-Page.php>   
                <div class="view">
                    <input type="text" id="search" name="search2" required placeholder="Search...">
					<input type="submit" class="searchbtn" name="search1" value="Search">
                </div>
            </form>
			<!--VIEW AND SEARCH FUNCTION END-->
            <!--ADD PRODUCT FUNCTION START-->
            <form method=POST action=Inventory-Function.php enctype="multipart/form-data">   
                <div class="insert">
                    <h1>INSERT PRODUCT</h1>
                    <h4>Product Name:       <input required type=text placeholder="Product Name" name=prodn></h4>
                    <h4>Product Description:<input required type=text placeholder="Product Description" name=prodv></h4>
                    <h4>Product Category:   <input required type=text placeholder="Product Category" name=prodc></h4>
                    <h4>Product Quantity:   <input required type=number name=prodq min="1" value="1"></h4>
                    <h4>Product Price:      <input required type=number name=prodp min="1" value="1"></h4>
                                            <input type="submit" class="addbtn" name="add" value="Add Product">
                </div>
                <div class="IsertImage">
                    <input type="file" required name="insertedImage" accept="image/*" onchange="loadFile(event)">
                        <div class="empty-text">
                            <img id="output"/>                            
                        </div>
                        <script>
                          var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                        </script>
                </div>
            </form> 
            <!--ADD PRODUCT FUNCTION END-->
			<!--UPDATE FUNCTION START-->
            <form method=POST action=Inventory-Function.php enctype="multipart/form-data">        
                <div class="update">
                    <h1>UPDATE PRODUCT</h1>
                    <h4>Product ID:			<input class="read" readonly value="<?php if(!empty($_GET['id'])){$id = $_GET['id'];echo$id;}?>" placeholder="Product Id" type=text name=prodid></h4>
					<h4>Product Name:		<input required value="<?php if(!empty($_GET['name'])){$name = $_GET['name'];echo$name;}?>" type=text placeholder="Product Name" name=prodname></h4>
                    <h4>Product Description:<input required value="<?php if(!empty($_GET['var'])){$var = $_GET['var'];echo $var;}?>"type=text placeholder="Product Description" name=prodvar></h4>
					<h4>Product Category:	<input required value="<?php if(!empty($_GET['cat'])){$cat  = $_GET['cat'];echo$cat;}?>"type=text placeholder="Product Category" name=prodcat></h4>
					<h4>Product Quantity:	<input required value="<?php if(!empty($_GET['quan'])){$quan = $_GET['quan'];echo$quan;}?>"type=number name=prodquan min="1"></h4>
					<h4>Product Price:		<input required value="<?php if(!empty($_GET['price'])){$price = $_GET['price'];echo$price;}?>"type=number name=prodprice min="1"></h4>
					                        <input type="submit" class="updatebtn" name="update" value="Update Product">
                </div>
                <div class="UploadImage">
                    <input type="file" name="uploadedImage" accept="image/*" onchange="loadFile2(event)">
                        <div class="empty-text2">
                            <img id="output2"/>                            
                        </div>
                        <script>
                        var loadFile2 = function(event) {
                            var output2 = document.getElementById('output2');
                            output2.src = URL.createObjectURL(event.target.files[0]);
                            output2.onload = function() {
                            URL.revokeObjectURL(output2.src) // free memory
                            }
                        };
                        </script>
                </div>
            </form>
			<!--UPDATE FUNCTION END-->
        </div> 
    </div>
</body>
</html>
<?php
include "db_conn.php";

//SEARCH FUNCTION BEGIN
if(isset($_POST['search1']))
{
	
    $search=$_POST['search2'];
    $view="SELECT * FROM tbl_product WHERE PROD_ID LIKE '%$search%' OR PROD_VARIANT LIKE '%$search%' OR PROD_CAT LIKE '%$search%' OR PROD_NAME LIKE '%$search%' ORDER BY PROD_QUANTITY";
    
	
    $result=$conn->query($view);

                            
            if ($result->num_rows>0)
            {
                echo"<div class=viewprod>";
                echo"<a class=cancel href=Admin-Page.php>Cancel</a>";
                echo"<div class=titlecard>";
                    echo "<h4 class='id'> ID ";
                    echo "<h4 class='name'> NAME ";
                    echo "<h4 class='var'> VARIENT";
                    echo "<h4 class='cat'> CATEGORY";
                    echo "<h4 class='quan'> QUANTITY";
                    echo "<h4 class='price'> PRICE "; 
                    echo "<h4 class='stat'> STATUS";
                    echo "<h4 class='act'> ACTION";
                echo"</div>";
                echo"<div class=prodcard>";

                echo "<table>";
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
						
                        $id=$row['PROD_ID'];
						$quant = $row['PROD_QUANTITY'];
                        if ($quant >=0 && $quant <= 99)
						{
                            $prodID=$row['PROD_ID'];
                            $prodNAME=$row['PROD_NAME'];
                            $prodVAR=$row['PROD_VARIANT'];
                            $prodCAT=$row['PROD_CAT'];
                            $prodQUAN=$row['PROD_QUANTITY'];
                            $prodPRICE=$row['PROD_PRICE'];

                        echo" <tr>";
                       // echo" <form method=POST action=addcart.php>";
					    echo" <td>".$row['PROD_ID'];
                        echo" <td>".$row['PROD_NAME'];
                        echo" <td>".$row['PROD_VARIANT'];
						echo" <td>".$row['PROD_CAT'];
						echo" <td>".$row['PROD_QUANTITY']; 
                        echo" <td>".$row['PROD_PRICE'];
                        echo" <td class=low> Low";
                        echo" <td><a id=upd href=Admin-Page.php?id=$prodID&name=$prodNAME&var=$prodVAR&cat=$prodCAT&quan=$prodQUAN&price=$prodPRICE
                                            title=Update >";
                        echo'<i class="fa fa-edit"></i></a>';
                        echo"            <a id=del title=Archive href=Archive-Function.php?prodid=$id>";
                        echo'<i class="fa fa-remove"></i></a>';
						}
						
						else if ($quant >=100 && $quant <= 200)
						{
                            $prodID=$row['PROD_ID'];
                            $prodNAME=$row['PROD_NAME'];
                            $prodVAR=$row['PROD_VARIANT'];
                            $prodCAT=$row['PROD_CAT'];
                            $prodQUAN=$row['PROD_QUANTITY'];
                            $prodPRICE=$row['PROD_PRICE'];
                        echo" <tr> ";
                       // echo" <form method=POST action=addcart.php>";
					    echo" <td> ".$row['PROD_ID'];
                        echo" <td>".$row['PROD_NAME'];
                        echo" <td>".$row['PROD_VARIANT'];
						echo" <td>".$row['PROD_CAT'];
						echo" <td>".$row['PROD_QUANTITY']; 
                        echo" <td>".$row['PROD_PRICE'];
						echo" <td class=medium> Medium";
                        echo" <td><a id=upd href=Admin-Page.php?id=$prodID&name=$prodNAME&var=$prodVAR&cat=$prodCAT&quan=$prodQUAN&price=$prodPRICE
                                            title=Update >";
                        echo'<i class="fa fa-edit"></i></a>';
                        echo"            <a id=del title=Archive href=Archive-Function.php?prodid=$id>";
                        echo'<i class="fa fa-remove"></i></a>';
						}
						else 
						{
                            $prodID=$row['PROD_ID'];
                            $prodNAME=$row['PROD_NAME'];
                            $prodVAR=$row['PROD_VARIANT'];
                            $prodCAT=$row['PROD_CAT'];
                            $prodQUAN=$row['PROD_QUANTITY'];
                            $prodPRICE=$row['PROD_PRICE'];
                        echo" <tr>";
                      //  echo" <form method=POST action=addcart.php>";
						echo" <td> ".$row['PROD_ID'];
                        echo" <td>".$row['PROD_NAME'];
                        echo" <td>".$row['PROD_VARIANT'];
						echo" <td>".$row['PROD_CAT'];
						echo" <td>".$row['PROD_QUANTITY']; 
                        echo" <td>".$row['PROD_PRICE'];
                        echo" <td class=high> High";
                        echo" <td><a id=upd href=Admin-Page.php?id=$prodID&name=$prodNAME&var=$prodVAR&cat=$prodCAT&quan=$prodQUAN&price=$prodPRICE
                                            title=Update >";
                        echo'<i class="fa fa-edit"></i></a>';
                        echo"            <a id=del title=Archive href=Archive-Function.php?prodid=$id>";
                        echo'<i class="fa fa-remove"></i></a>';
						}
						
                        }

            }
            else
            {
                echo"<div class=viewprod>";
                echo"<a class=cancel href=Admin-Page.php>Cancel</a>";
                echo"<div class=titlecard>";
                    echo "<h4 class='id'> ID ";
                    echo "<h4 class='name'> NAME ";
                    echo "<h4 class='var'> VARIENT";
                    echo "<h4 class='cat'> CATEGORY";
                    echo "<h4 class='quan'> QUANTITY";
                    echo "<h4 class='price'> PRICE "; 
                    echo "<h4 class='stat'> STATUS";
                    echo "<h4 class='act'> ACTION";
                echo"</div>";
                echo"<p class=noitem>No Item Found!</p>";
            }
        
}
else
{    
    $view="SELECT * FROM tbl_product WHERE PROD_STATUS != 'ARCHIVED' ORDER BY PROD_QUANTITY";
    
    $result=$conn->query($view);

                            
            if ($result->num_rows>0)
            {
                echo"<div class=viewprod>";
                echo"<div class=titlecard>";
                    echo "<h4 class='id'> ID ";
                    echo "<h4 class='name'> NAME ";
                    echo "<h4 class='var'> VARIENT";
                    echo "<h4 class='cat'> CATEGORY";
                    echo "<h4 class='quan'> QUANTITY";
                    echo "<h4 class='price'> PRICE "; 
                    echo "<h4 class='stat'> STATUS";
                    echo "<h4 class='act'> ACTION";
                echo"</div>";
                echo"<div class=prodcard>";

                echo "<table>";
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
						
                        $id=$row['PROD_ID'];
						$quant = $row['PROD_QUANTITY'];
                        if ($quant >=0 && $quant <= 99)
						{
                            $prodID=$row['PROD_ID'];
                            $prodNAME=$row['PROD_NAME'];
                            $prodVAR=$row['PROD_VARIANT'];
                            $prodCAT=$row['PROD_CAT'];
                            $prodQUAN=$row['PROD_QUANTITY'];
                            $prodPRICE=$row['PROD_PRICE'];
                        echo" <tr>";
                       // echo" <form method=POST action=addcart.php>";
					    echo" <td>".$row['PROD_ID'];
                        echo" <td>".$row['PROD_NAME'];
                        echo" <td>".$row['PROD_VARIANT'];
						echo" <td>".$row['PROD_CAT'];
						echo" <td>".$row['PROD_QUANTITY']; 
                        echo" <td>".$row['PROD_PRICE'];
                        echo" <td class=low> Low";
                        echo" <td><a id=upd href=Admin-Page.php?id=$prodID&name=$prodNAME&var=$prodVAR&cat=$prodCAT&quan=$prodQUAN&price=$prodPRICE
                                            title=Update >";
                        echo'<i class="fa fa-edit"></i></a>';
                        echo"            <a id=del title=Archive href=Archive-Function.php?prodid=$id>";
                        echo'<i class="fa fa-remove"></i></a>';
						}
						
						else if ($quant >=100 && $quant <= 200)
						{
                            $prodID=$row['PROD_ID'];
                            $prodNAME=$row['PROD_NAME'];
                            $prodVAR=$row['PROD_VARIANT'];
                            $prodCAT=$row['PROD_CAT'];
                            $prodQUAN=$row['PROD_QUANTITY'];
                            $prodPRICE=$row['PROD_PRICE'];
                        echo" <tr> ";
                       // echo" <form method=POST action=addcart.php>";
					    echo" <td> ".$row['PROD_ID'];
                        echo" <td>".$row['PROD_NAME'];
                        echo" <td>".$row['PROD_VARIANT'];
						echo" <td>".$row['PROD_CAT'];
						echo" <td>".$row['PROD_QUANTITY']; 
                        echo" <td>".$row['PROD_PRICE'];
						echo" <td class=medium> Medium";
                        echo" <td><a id=upd href=Admin-Page.php?id=$prodID&name=$prodNAME&var=$prodVAR&cat=$prodCAT&quan=$prodQUAN&price=$prodPRICE
                                            title=Update >";
                        echo'<i class="fa fa-edit"></i></a>';
                        echo"            <a id=del title=Archive href=Archive-Function.php?prodid=$id>";
                        echo'<i class="fa fa-remove"></i></a>';
						}
						else 
						{
                            $prodID=$row['PROD_ID'];
                            $prodNAME=$row['PROD_NAME'];
                            $prodVAR=$row['PROD_VARIANT'];
                            $prodCAT=$row['PROD_CAT'];
                            $prodQUAN=$row['PROD_QUANTITY'];
                            $prodPRICE=$row['PROD_PRICE'];
                        echo" <tr>";
                      //  echo" <form method=POST action=addcart.php>";
						echo" <td> ".$row['PROD_ID'];
                        echo" <td>".$row['PROD_NAME'];
                        echo" <td>".$row['PROD_VARIANT'];
						echo" <td>".$row['PROD_CAT'];
						echo" <td>".$row['PROD_QUANTITY']; 
                        echo" <td>".$row['PROD_PRICE'];
                        echo" <td class=high> High";
                        echo" <td><a id=upd href=Admin-Page.php?id=$prodID&name=$prodNAME&var=$prodVAR&cat=$prodCAT&quan=$prodQUAN&price=$prodPRICE
                                            title=Update >";
                        echo'<i class="fa fa-edit"></i></a>';
                        echo"            <a id=del title=Archive href=Archive-Function.php?prodid=$id>";
                        echo'<i class="fa fa-remove"></i></a>';
						}
						
                        }

            }
	// echo"Item Dsplay when nothing is being search";
}
//SEARCH FUNCTION END

?>
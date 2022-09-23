<html>
<head>
	<title>Admin Page</title>
</head>
 	<body>
	<form method=POST action=admin.php>
  		<div>
			<div>
				<div>
					
					<div>
						
						<a href="accounts.php">Accounts</a>
						<a href="logs.php">Logs</a>
						<a href="inventory.php">Inventory</a>
						<a href="reports.php">Reports</a>
						<a href="archive.php">Archive</a>
						
					</div>

					<!--ADD PRODUCT FUNCTION START-->
					<h4>Product Name:		<input required type=text name=prodn autofocus></h4>
					<h4>Product Varient:	<input required type=text name=prodv></h4>
					<h4>Product Category:	<input required type=text name=prodc></h4>
					<h4>Product Quantity:	<input required type=number name=prodq value="0" ></h4>
					<h4>Product Price:		<input required type=number name=prodp value="0" ></h4>
					<input type="submit" name="add" value="Add Product"><br><br><br><br><br>
					<!--ADD PRODUCT FUNCTION END-->
</form>
					<form method=POST action=admin.php>

					<!--UPDATE FUNCTION START-->
					<h4>Product ID:			<input required type=text name=prodid autofocus></h4>
					<h4>Product Name:		<input required type=text name=prodname></h4>
					<h4>Product Varient:	<input required type=text name=prodvar></h4>
					<h4>Product Category:	<input required type=text name=prodcat></h4>
					<h4>Product Quantity:	<input required type=number name=prodquan value="0" ></h4>
					<h4>Product Price:		<input required type=number name=prodprice value="0" ></h4>
					<input type="submit" name="update" value="Update Product"><br><br><br><br><br>
					<!--UPDATE FUNCTION END-->
</form>

					<form method=POST action=admin.php>
					<!--SEARCH FUNCTION START-->
					<input type="text" name="search2" placeholder="search" style="margin-left:500px; width:350px; height:20px">
					<input type="submit" name="search1" value="search"><br><br><br><br><br><br>
					<!--SEARCH FUNCTION END-->
				</div>
			</div>
		</div>
</form>
  </body>
</html>

<?php 
include "db_conn.php";

//UPDATE PRODUCT FUNCTION BEGIN
if(isset($_POST['update']))
{
	$prod_id=$_POST['prodid'];
    $prod_name=$_POST['prodname'];
	$prod_var=$_POST['prodvar'];
	$prod_cat=$_POST['prodcat'];
	$prod_quan=$_POST['prodquan'];
	$prod_price=$_POST['prodprice'];
	
	echo "<br>".$prod_id;
	echo "<br>".$prod_name;
	echo "<br>".$prod_var;
	echo "<br>".$prod_cat;
	echo "<br>".$prod_quan;
	echo "<br>".$prod_price;
	
	if($prod_id != null && $prod_name != null && $prod_var != null && $prod_cat != null && $prod_quan != 0 && $prod_price != 0)
	{
	$update1="UPDATE tbl_product SET PROD_NAME ='$prod_name' WHERE PROD_ID = '$prod_id'";
	$update2="UPDATE tbl_product SET PROD_VARIANT ='$prod_var' WHERE PROD_ID = '$prod_id'";
	$update3="UPDATE tbl_product SET PROD_QUANTITY ='$prod_quan' WHERE PROD_ID = '$prod_id'";
	$update4="UPDATE tbl_product SET PROD_PRICE ='$prod_price' WHERE PROD_ID = '$prod_id'";
	$update5="UPDATE tbl_product SET PROD_CAT ='$prod_cat' WHERE PROD_ID = '$prod_id'";
	
	$conn->query($update1);
	$conn->query($update2);
	$conn->query($update3);
	$conn->query($update4);
	$conn->query($update5);
	echo "Success";
	} 
	else
	{
		echo "Please enter valid inputs";
	}
}
else
{
	echo"rereer";
}
//UPDATE PRODUCT FUNCTION END

//ADD PRODUCT FUNCTION BEGIN
if(isset($_POST['add']))
{
    $prod_name=$_POST['prodn'];
	$prod_var=$_POST['prodv'];
	$prod_cat=$_POST['prodc'];
	$prod_quan=$_POST['prodq'];
	$prod_price=$_POST['prodp'];
	
	if($prod_name != null && $prod_var != null && $prod_cat != null && $prod_quan != 0 && $prod_price != 0)
	{
	$insert="insert into tbl_product(PROD_NAME,PROD_QUANTITY,PROD_PRICE,PROD_VARIANT,PROD_CAT) 
	values('$prod_name','$prod_quan','$prod_price','$prod_var','$prod_cat')";

    $conn->query($insert);
	echo "Success";
	} 
	else
	{
		echo "Please enter valid inputs";
	}
}
else
{
	echo"rereer";
}
//ADD PRODUCT FUNCTION END



//SEARCH FUNCTION BEGIN
if(isset($_POST['search1']))
{
	
    $search=$_POST['search2'];
    $view="SELECT * FROM tbl_product WHERE PROD_ID LIKE '%$search%' OR PROD_VARIANT LIKE '%$search%' OR PROD_CAT LIKE '%$search%' OR PROD_NAME LIKE '%$search%' ORDER BY PROD_QUANTITY";
    
	
    $result=$conn->query($view);

                            
            if ($result->num_rows>0)
            {
                echo "<center><a href=home.php><h1>PRODUCTS</h1></a>";
                echo "<table border= 1 cellpadding=20>";
	
				echo "<th> PRODUCT ID ";
                echo "<th> PRODUCT NAME ";
				echo "<th> PRODUCT VARIENT";
				echo "<th> PRODUCT CATEGORY";
                echo "<th> PRODUCT QUANTITY";
                echo "<th> PRODUCT PRICE "; 
                echo "<th> PRODUCT STATUS";
        
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
						
                        $id=$row['PROD_ID'];
						$quant = $row['PROD_QUANTITY'];
                        if ($quant >=0 && $quant <= 99)
						{
                        echo" <tr>";
                       // echo" <form method=POST action=addcart.php>";
					    echo" <td>".$row['PROD_ID'];
                        echo" <td>  <FONT COLOR=red>".$row['PROD_NAME'];
                        echo" <td>  <FONT COLOR=red>".$row['PROD_VARIANT'];
						echo" <td>  <FONT COLOR=red>".$row['PROD_CAT'];
						echo" <td>  <FONT COLOR=red>".$row['PROD_QUANTITY']; 
                        echo" <td>  <FONT COLOR=red>".$row['PROD_PRICE'];
                        echo" <td>  <FONT COLOR=red> Low";
						}
						
						else if ($quant >=100 && $quant <= 200)
						{
                        echo" <tr> ";
                       // echo" <form method=POST action=addcart.php>";
					    echo" <td> ".$row['PROD_ID'];
                        echo" <td> <FONT COLOR=yellow>".$row['PROD_NAME'];
                        echo" <td> <FONT COLOR=yellow>".$row['PROD_VARIANT'];
						echo" <td> <FONT COLOR=yellow>".$row['PROD_CAT'];
						echo" <td> <FONT COLOR=yellow>".$row['PROD_QUANTITY']; 
                        echo" <td> <FONT COLOR=yellow>".$row['PROD_PRICE'];
						echo" <td> <FONT COLOR=yellow> Medium";
						}
						else 
						{
                        echo" <tr>";
                      //  echo" <form method=POST action=addcart.php>";
						echo" <td> ".$row['PROD_ID'];
                        echo" <td> <FONT COLOR=green>".$row['PROD_NAME'];
                        echo" <td> <FONT COLOR=green>".$row['PROD_VARIANT'];
						echo" <td> <FONT COLOR=green>".$row['PROD_CAT'];
						echo" <td> <FONT COLOR=green>".$row['PROD_QUANTITY']; 
                        echo" <td> <FONT COLOR=green>".$row['PROD_PRICE'];
                        echo" <td> <FONT COLOR=green> High";
						}
						
                        }

            }
            else
            {
                echo "Invalid Search!";
            }
        
}
else
{
	echo"Item Dsplay when nothing is being search";
}
//SEARCH FUNCTION END

?>
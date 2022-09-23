<html>
<head>
	<title>Logs</title>
</head>
 	<body>
	<form method=POST action=sample.php>
  		<div>
			<div>
				<div>
					<div>
					<!--VIEW ACCOUNT LOGS FUNCTION START-->
					<h4><input type="submit" name="acclog" value="View Account Logs"><br><br><br><br><br></h4>
					<!--VIEW ACCOUNT LOGS FUNCTION END-->
					<!--VIEW PENDING LOGS FUNCTION START-->
					<h4><input type="submit" name="pending" value="View Pending Orders"><br><br><br><br><br></h4>
					<!--VIEW PENDING LOGS FUNCTION END-->
					<!--VIEW ACCEPTED LOGS FUNCTION START-->
					<h4><input type="submit" name="accepted" value="View Accepted Orders"><br><br><br><br><br></h4>
					<!--VIEW ACCEPTED LOGS FUNCTION END-->
					<!--VIEW DECLINED LOGS FUNCTION START-->
					<h4><input type="submit" name="declined" value="View Declined Orders"><br><br><br><br><br></h4>
					<!--VIEW DECLINED LOGS FUNCTION END-->
				</div>
			</div>
		</div>
</form>
  </body>
</html>

<?php 
include "db_conn.php";

if(isset($_POST['acclog']))
{
//VIEW ACCOUNT LOGS FUNCTION BEGIN
    $view="SELECT * FROM tbl_logs ORDER BY LOGS_DATE";
    $result=$conn->query($view);
            if ($result->num_rows>0)
            {
                echo "<center><h1>Account Logs</h1></a>";
                echo "<table border= 1 cellpadding=20>";
				echo "<th> User ";
                echo "<th> Action Logs";
				echo "<th> Date";
                        while ($row= $result ->fetch_assoc())
                        {
						echo" <tr>";
                        echo" <td>".$row['LOGS_NAME'];
                        echo" <td>".$row['LOGS_ACTION'];
						echo" <td>".$row['LOGS_DATE'];
						}

            }
            else
            {
                echo "Invalid Search!";
            }
        
}
else
{
	
}
//VIEW ACCOUNT LOGS FUNCTION END

//PENDING LOGS FUNCTION BEGIN
if(isset($_POST['pending']))
{
    $view="SELECT * FROM tbl_order WHERE ORDER_STATUS = 'PENDING' ORDER BY ORDER_PAYMENT";
    $result=$conn->query($view);
	
	$view1="SELECT * FROM tbl_res WHERE RES_PRODSTAT = 'PENDING'";
    $result1=$conn->query($view1);
                            
			echo "<center><h1>Pending Order Logs</h1></a>";
            echo "<table border= 1 cellpadding=20>";
			echo "<th> Order Invoice ";
            echo "<th> Name ";
			echo "<th> Details";
			echo "<th> Quantity";
			echo "<th> Total Order";
			echo "<th> Order Payment";
			echo "<th> Total Price";
			echo "<th> Order Validity";
			echo "<th> Status";
			echo "<th> Action";
				
            if ($result->num_rows>0)
            {
                
        
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
						$prod_ID = $row['ORDER_ID'];
                        echo" <tr>";
					    echo" <td>".$row['ORDER_INVOICE'];
                        echo" <td>".$row['ORDER_NAME'];
                        echo" <td>".$row['ORDER_DETAILS'];
						echo" <td>".$row['ORDER_QUANTITY'];
						echo" <td>".$row['ORDER_TOTAL'];
                        echo" <td>".$row['ORDER_PAYMENT'];
                        echo" <td>".$row['ORDER_TOTALPRICE'];
						echo" <td>".$row['ORDER_VALIDITY'];
						echo" <td>".$row['ORDER_STATUS'];
						echo" <td><a href=Approve-Function.php?id=$prod_ID title=Approve> Approve </a>";
						echo "<a href=Delete-Function.php?id=$prod_ID title=Delete> Delete </a>";
						}

            }
            else
            {
            }          
            if ($result1->num_rows>0)
            {
                // echo "<th COLSPAN =2> ACTION";
                        while ($row1= $result1 ->fetch_assoc())
                        {
						$prod_ID = $row1['RES_ID'];
                        echo" <tr>";
					    echo" <td>".$row1['RES_PROD_ID'];
                        echo" <td>".$row1['RES_PRODNAME'];
                        echo" <td>".$row1['RES_PRODVAR'];
						echo" <td>".$row1['RES_PRODQUAN'];
						echo" <td>".$row1['RES_PRODPRICE'];
                        echo" <td>".$row1['RES_PRODOWN'];
                        echo" <td>".$row1['RES_PRODTOTAL'];
						echo" <td>".$row1['RES_USER'];
						echo" <td>".$row1['RES_PRODSTAT'];
						echo" <td><a href=Approve-Function.php?id=$prod_ID title=Approve> Approve </a>";
						echo "<a href=Delete-Function.php?id=$prod_ID title=Delete> Delete </a>";
						}

            }
            else
            {
                
            }
        
}
else
{
	
}
//PENDING LOGS FUNCTION END


//ACCEPTED LOGS FUNCTION BEGIN
if(isset($_POST['accepted']))
{
    $view="SELECT * FROM tbl_order WHERE ORDER_STATUS = 'ACCEPTED' ORDER BY ORDER_PAYMENT";
    $result=$conn->query($view);
	
	$view1="SELECT * FROM tbl_res WHERE RES_PRODSTAT = 'ACCEPTED'";
    $result1=$conn->query($view1);
                            
			echo "<center><h1>Accepted Order Logs</h1></a>";
            echo "<table border= 1 cellpadding=20>";
			echo "<th> Order Invoice ";
            echo "<th> Name ";
			echo "<th> Details";
			echo "<th> Quantity";
			echo "<th> Total Order";
			echo "<th> Order Payment";
			echo "<th> Total Price";
			echo "<th> Order Validity";
			echo "<th> Status";
			echo "<th> Action";
				
            if ($result->num_rows>0)
            {
                
        
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
						$prod_ID = $row['ORDER_ID'];
                        echo" <tr>";
					    echo" <td>".$row['ORDER_INVOICE'];
                        echo" <td>".$row['ORDER_NAME'];
                        echo" <td>".$row['ORDER_DETAILS'];
						echo" <td>".$row['ORDER_QUANTITY'];
						echo" <td>".$row['ORDER_TOTAL'];
                        echo" <td>".$row['ORDER_PAYMENT'];
                        echo" <td>".$row['ORDER_TOTALPRICE'];
						echo" <td>".$row['ORDER_VALIDITY'];
						echo" <td>".$row['ORDER_STATUS'];
						echo" <td><a href=Delete-Function.php?id=$prod_ID title=Delete> Delete </a>";
						}

            }
            else
            {
            }          
            if ($result1->num_rows>0)
            {
                // echo "<th COLSPAN =2> ACTION";
                        while ($row1= $result1 ->fetch_assoc())
                        {
						$prod_ID = $row1['RES_ID'];
                        echo" <tr>";
					    echo" <td>".$row1['RES_PROD_ID'];
                        echo" <td>".$row1['RES_PRODNAME'];
                        echo" <td>".$row1['RES_PRODVAR'];
						echo" <td>".$row1['RES_PRODQUAN'];
						echo" <td>".$row1['RES_PRODPRICE'];
                        echo" <td>".$row1['RES_PRODOWN'];
                        echo" <td>".$row1['RES_PRODTOTAL'];
						echo" <td>".$row1['RES_USER'];
						echo" <td>".$row1['RES_PRODSTAT'];
						echo" <td><a href=Delete-Function.php?id=$prod_ID title=Delete> Delete </a>";
						}

            }
            else
            {
                
            }
        
}
else
{
	
}
//ACCEPTED LOGS FUNCTION END

//DECLINED LOGS FUNCTION BEGIN
if(isset($_POST['declined']))
{
    $view="SELECT * FROM tbl_order WHERE ORDER_STATUS = 'DECLINED' ORDER BY ORDER_PAYMENT";
    $result=$conn->query($view);
	
	$view1="SELECT * FROM tbl_res WHERE RES_PRODSTAT = 'DECLINED'";
    $result1=$conn->query($view1);
                            
			echo "<center><h1>Pending Order Logs</h1></a>";
            echo "<table border= 1 cellpadding=20>";
			echo "<th> Order Invoice ";
            echo "<th> Name ";
			echo "<th> Details";
			echo "<th> Quantity";
			echo "<th> Total Order";
			echo "<th> Order Payment";
			echo "<th> Total Price";
			echo "<th> Order Validity";
			echo "<th> Status";
			echo "<th> Action";
				
            if ($result->num_rows>0)
            {
                
        
                // echo "<th COLSPAN =2> ACTION";
                            
                        while ($row= $result ->fetch_assoc())
                        {
						$prod_ID = $row['ORDER_ID'];
                        echo" <tr>";
					    echo" <td>".$row['ORDER_INVOICE'];
                        echo" <td>".$row['ORDER_NAME'];
                        echo" <td>".$row['ORDER_DETAILS'];
						echo" <td>".$row['ORDER_QUANTITY'];
						echo" <td>".$row['ORDER_TOTAL'];
                        echo" <td>".$row['ORDER_PAYMENT'];
                        echo" <td>".$row['ORDER_TOTALPRICE'];
						echo" <td>".$row['ORDER_VALIDITY'];
						echo" <td>".$row['ORDER_STATUS'];
						echo" <td><a href=Approve-Function.php?id=$prod_ID title=Approve> Approve </a>";
						}

            }
            else
            {
            }          
            if ($result1->num_rows>0)
            {
                // echo "<th COLSPAN =2> ACTION";
                        while ($row1= $result1 ->fetch_assoc())
                        {
						$prod_ID = $row1['RES_ID'];
                        echo" <tr>";
					    echo" <td>".$row1['RES_PROD_ID'];
                        echo" <td>".$row1['RES_PRODNAME'];
                        echo" <td>".$row1['RES_PRODVAR'];
						echo" <td>".$row1['RES_PRODQUAN'];
						echo" <td>".$row1['RES_PRODPRICE'];
                        echo" <td>".$row1['RES_PRODOWN'];
                        echo" <td>".$row1['RES_PRODTOTAL'];
						echo" <td>".$row1['RES_USER'];
						echo" <td>".$row1['RES_PRODSTAT'];
						echo" <td><a href=Approve-Function.php?id=$prod_ID title=Approve> Approve </a>";
						}

            }
            else
            {
                
            }
        
}
else
{
	
}
//DECLINED LOGS FUNCTION END

?>
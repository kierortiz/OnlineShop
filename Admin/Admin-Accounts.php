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
    <link rel="stylesheet" href="Css/Account.css" type="text/Css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Blessed4J's || Admin Accounts</title>
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
  		<div class="form-container">
		    <form method=POST action=Admin-Accounts.php>				
				<div class="form-create"><!--CREATE ACCOUNT FUNCTION START-->
					<h1>CREATE ACCOUNT</h1>				
					<h4>First Name:			</h4><input required type=text name=accfname autofocus>
					<h4>Last Name:			</h4><input required type=text name=acclname>
					<h4>Contact No.:		</h4><input required type=tel name=accno >
					<h4>Username:			</h4><input required type=text name=accuser >
					<h4>Password:			</h4><input required type=password name=accpass >
					<h4>Confirm Password:	</h4><input required type=password name=accpass2 >
					<h4>Position:</h4>		<select name=position>
												<option value=Administrator>Administrator</option>
												<option value=Employee>Employee</option>
											</select>
					<input class="createbtn" type="submit" name="create" value="Create">
				</div><!--CREATE ACCOUNT FUNCTION END-->
		    </form>	
					<!--CUSTOMER VIEW FUNCTION START-->
					<!-- <input type="submit" name="viewcust" value="View Customers"><br><br><br><br><br><br> -->
					<!--CUSTOMER VIEW SEARCH FUNCTION END-->
					<!--ADMIN 7 EMP VIEW FUNCTION START-->
					<!-- <input type="submit" name="viewadmin" value="View Admin/Employee"><br><br><br><br><br><br> -->
					<!--ADMIN 7 EMP VIEW SEARCH FUNCTION END-->

			<form method=POST action=Admin-Accounts.php>	
				<div class="form-update"><!--UPDATE FUNCTION START-->
					<h1>UPDATE ACCOUNT		</h1>
					<h4>Account ID:			</h4><input class="read" readonly type=text name=accid value="<?php if(!empty($_GET['id'])){$id = $_GET['id'];echo$id;}?>">
					<h4>Position:</h4>		<select name=position>
												<option value="<?php if(!empty($_GET['position'])){$position=$_GET['position'];echo $position;}?>"><?php if(!empty($_GET['position'])){$position=$_GET['position'];echo $position;}?></option>
												<option value=Administrator>Administrator</option>
												<option value=Employee>Employee</option>
											</select>
					<h4>First Name:			</h4><input type=text name=accfname value="<?php if(!empty($_GET['fname'])){$fname=$_GET['fname'];echo $fname;}?>">
					<h4>Last Name:			</h4><input type=text name=acclname value="<?php if(!empty($_GET['lname'])){$lname=$_GET['lname'];echo $lname;}?>">
					<h4>Contact No.:		</h4><input type=tel name=accno value="<?php if(!empty($_GET['contact'])){$contact=$_GET['contact'];echo $contact;}?>">
					<h4>Username:			</h4><input type=text name=accuser value="<?php if(!empty($_GET['uname'])){$uname=$_GET['uname'];echo $uname;}?>">
					<h4>Password:			</h4><input type=password name=accpass>
					<h4>Confirm Password:	</h4><input type=password name=accpass2>
					
					<input class="updatebtn" type="submit" name="update" value="Update">
				</div><!--UPDATE FUNCTION END-->
		   </form>
		</div>
    </div>
</body>
</html>
<?php 
// ung get para hindi manual ung mag type sa update tas ung nawala ung mga tinype kapay may mali 
// next sem ayusin un pati ung mga error message dapat paayos

include "db_conn.php";
$login_name = $_SESSION["name"];
$login_user = $_SESSION["username"];
$login_pos = $_SESSION["position"];
//CREATE ACCOUNT FUNCTION BEGIN
if(isset($_POST['create']))
{
	
    $acc_fname=$_POST['accfname'];
	$acc_lname=$_POST['acclname'];
	$acc_user=$_POST['accuser'];
	$acc_no=$_POST['accno'];
	$acc_pass=$_POST['accpass'];
	$acc_pass2=$_POST['accpass2'];
	$acc_pos=$_POST['position'];
	
	if($acc_fname != null && $acc_lname != null && $acc_user != null && $acc_pass != null && $acc_pass2 != null && $acc_no != 0)
	{
		$view="SELECT * FROM tbl_account WHERE ACC_USER = '$acc_user' OR ACC_CONTACT = '$acc_no'";
		$result=$conn->query($view);
			if ($result->num_rows>0)
            {
				while ($row= $result ->fetch_assoc())
				{
					$get_user = $row['ACC_USER'];
					$get_name = $row['ACC_FNAME'];
					$get_no = $row['ACC_CONTACT'];
					$get_pos = $row['ACC_POSITION'];
				}
				if ($get_user === $acc_user)
				{
					?>
						<script>
							alert("Username already taken")
						</script>
					<?php
					//echo "Username already taken";
				}
				else if ($get_no === $acc_no)
				{
					?>
						<script>
							alert("Contact Number already taken")
						</script>
					<?php
					//echo "Contact Number already taken";
				}
				else if ($get_name === $acc_fname && $get_pos === $acc_pos)
				{
					?>
						<script>
							alert("Duplicate Account Not Allowed")
						</script>
					<?php
					//echo "Duplicate Account Not Allowed";
				}
			}
			else
			{
					if($acc_pass == $acc_pass2)
					{
					//CREATE WITH LOG FUNCTION BEGIN
					$insert="insert into tbl_account(ACC_USER,ACC_PASS,ACC_FNAME,ACC_LNAME,ACC_CONTACT,ACC_POSITION) 
					values('$acc_user','$acc_pass','$acc_fname','$acc_lname','$acc_no','$acc_pos')";
					$conn->query($insert);
					
					$insert3="insert into tbl_logs(LOGS_NAME,LOGS_ACTION,LOGS_DATE) 
					values('$login_name','Created an $acc_pos account for $acc_fname',NOW())";
					$conn->query($insert3);
					//CREATE WITH LOG FUNCTION END
					?>
					<script>
						alert("Account Successfully Created")
					</script>
					<?php
					//echo "Success";
					}
					else if($acc_pass != $acc_pass2)
					{
						?>
							<script>
								alert("Password does not match")
							</script>
						<?php
						//echo "Password does not match";
					}
				
			}
	} 
	else
	{
		echo "Please fill all lines";
	}
}
else
{
}
//CREATE ACCOUNT FUNCTION END


//UPDATE ACCOUNT FUNCTION BEGIN
if(isset($_POST['update']))
{
    $acc_fname=$_POST['accfname'];
	$acc_lname=$_POST['acclname'];
	$acc_user=$_POST['accuser'];
	$acc_id=$_POST['accid'];
	$acc_no=$_POST['accno'];
	$acc_pass=$_POST['accpass'];
	$acc_pass2=$_POST['accpass2'];
	$acc_pos=$_POST['position'];
	
	if($acc_fname != null && $acc_lname != null && $acc_user != null && $acc_pass != null && $acc_pass2 != null && $acc_no != null && $acc_id != null)
	{
		$view="SELECT * FROM tbl_account WHERE ACC_ID = '$acc_id'";
		$result=$conn->query($view);
			if ($result->num_rows>0)
            {
				while ($row= $result ->fetch_assoc())
				{
					$get_id = $row['ACC_ID'];
					$get_user = $row['ACC_USER'];
					$get_name = $row['ACC_FNAME'];
					$get_last = $row['ACC_LNAME'];
					$get_no = $row['ACC_CONTACT'];
					$get_pos = $row['ACC_POSITION'];
				}
				if ($get_user == $acc_user && $acc_id != $get_id)
					{
						?>
							<script>
								alert("Username already taken")
							</script>
						<?php
						//echo "Username already taken";
					}
					else if ($get_no == $acc_no && $get_id != $acc_id)
					{
						?>
							<script>
								alert("Contact Number already taken")
							</script>
						<?php
						//echo "Contact Number already taken";
					}
					else if ($get_user == $acc_user && $get_id != $acc_id)
					{
						?>
							<script>
								alert("Duplicate Account Not Allowed")
							</script>
						<?php
						//echo "Duplicate Account Not Allowed";
					}
			else
			{
				if($acc_pass == $acc_pass2)
				{
				$update1="UPDATE tbl_account SET ACC_USER ='$acc_user' WHERE ACC_ID = '$acc_id'";
				$update2="UPDATE tbl_account SET ACC_PASS ='$acc_pass' WHERE ACC_ID = '$acc_id'";
				$update3="UPDATE tbl_account SET ACC_FNAME ='$acc_fname' WHERE ACC_ID = '$acc_id'";
				$update4="UPDATE tbl_account SET ACC_LNAME ='$acc_lname' WHERE ACC_ID = '$acc_id'";
				$update5="UPDATE tbl_account SET ACC_CONTACT ='$acc_no' WHERE ACC_ID = '$acc_id'";
				$update6="UPDATE tbl_account SET ACC_POSITION ='$acc_pos' WHERE ACC_ID = '$acc_id'";
		
				$conn->query($update1);
				$conn->query($update2);
				$conn->query($update3);
				$conn->query($update4);
				$conn->query($update5);
				$conn->query($update6);
				?>
				<script>
					alert("Account Successfully Updated")
				</script>
				<?php
				
				$insert4="insert into tbl_logs(LOGS_NAME,LOGS_ACTION,LOGS_DATE) 
				values('$login_name','Updated an account of $acc_fname',NOW())";
				$conn->query($insert4);
				}
				else
				{
					?>
					<script>
						alert("Password does not match")
					</script>
					<?php
					//echo "Password does not match";
				}
			} 
			}
	}
	else
	{
		?>
		<script>
			alert("Please fill all lines")
		</script>
		<?php
		//echo "Please fill all lines";
	}
}
//UPDATE ACCOUNT FUNCTION END

// //CUSTOMER VIEW FUNCTION BEGIN
// if(isset($_POST['viewcust']))
// {
//     $view="SELECT * FROM tbl_account WHERE ACC_POSITION = 'Customer' ORDER BY ACC_LNAME";
    
	
//     $result=$conn->query($view);

                            
//             if ($result->num_rows>0)
//             {
//                 echo "<center><h1>CUSTOMER ACCOUNTS</h1></a>";
//                 echo "<table border= 1 cellpadding=20>";
// 				echo "<th> USERNAME ";
//                 echo "<th> FIRST NAME ";
// 				echo "<th> LAST NAME";
// 				echo "<th> CONTACT NO.";
        
//                 // echo "<th COLSPAN =2> ACTION";
                            
//                         while ($row= $result ->fetch_assoc())
//                         {
						
//                         echo" <tr>";
// 					    echo" <td>".$row['ACC_USER'];
//                         echo" <td>".$row['ACC_FNAME'];
//                         echo" <td>".$row['ACC_LNAME'];
// 						echo" <td>".$row['ACC_CONTACT'];
						
// 						}

//             }
//             else
//             {
//                 echo "Invalid Search!";
//             }
        
// }
// else
// {
// 	echo"rereer";
// }
//CUSTOMER VIEW FUNCTION END

//ADMIN 7 EMP VIEW FUNCTION BEGIN

    $view="SELECT * FROM tbl_account WHERE ACC_POSITION = 'Administrator' OR ACC_POSITION = 'Employee' ORDER BY ACC_POSITION";  
	
    $result=$conn->query($view);
                            
	if ($result->num_rows>0)
	{	
		echo"<div class=view>";
		echo"<div class=viewprod>";		
		echo"<div class=titlecard>";		
			echo "<h4 class=id> ID";
			echo "<h4 class=name> USERNAME ";
			echo "<h4 class=var> FIRST NAME ";
			echo "<h4 class=cat> LAST NAME";
			echo "<h4 class=quan> POSITION";
			echo "<h4 class=price> ACTION";
	    echo"</div></div>";
	    echo"<div class=prodcard>";
	    echo "<table>";
		while ($row= $result ->fetch_assoc())
		{		
			$id = $row['ACC_ID'];
			$uname = $row['ACC_USER'];
			$fname = $row['ACC_FNAME'];
			$lname = $row['ACC_LNAME'];
			$position = $row['ACC_POSITION'];
			$contact = $row['ACC_CONTACT'];

			echo" <tr>";
			echo" <td>".$row['ACC_ID'];
			echo" <td>".$row['ACC_USER'];
			echo" <td>".$row['ACC_FNAME'];
			echo" <td>".$row['ACC_LNAME'];
			echo" <td>".$row['ACC_POSITION'];
			echo" <td><a id=upd title=Edit href=Admin-Accounts.php?id=$id&uname=$uname&fname=$fname&lname=$lname&position=$position&contact=$contact>";
			echo'			<i class="fa fa-pencil"></i></i></a>';
			echo"			<a id=del title=Archive href=Archive-Function.php?id=$id>";
			echo'<i class="fa fa-user-times"></i></a>';
		}		
		echo"</table></div>";
	}
	// else
	// {
	//     echo "Invalid Search!";
	// }
  
//ADMIN 7 EMP VIEW FUNCTION END

?>
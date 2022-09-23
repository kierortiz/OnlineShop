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
		
	//Session
	$prod_user = $_SESSION['name'];
	$prod_pos = $_SESSION['position'];
	//Session end
	// echo "<br>".$prod_id;
	// echo "<br>".$prod_name;
	// echo "<br>".$prod_var;
	// echo "<br>".$prod_cat;
	// echo "<br>".$prod_quan;
	// echo "<br>".$prod_price;
	if(!empty($_FILES["uploadedImage"]["name"])) { 
		// Get file info 
		$fileName = basename($_FILES["uploadedImage"]["name"]); 
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
		 
		// Allow certain file formats 
		$allowTypes = array('jpg','png','jpeg','gif'); 
		if(in_array($fileType, $allowTypes)){ 
			$image = $_FILES['uploadedImage']['tmp_name']; 
			$imgContent = addslashes(file_get_contents($image)); 

			$img = $imgContent; //eto ung ilalagay sa insert
		}else{ 
			$statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
		} 
	}else{ 
		$statusMsg = 'Please select an image file to upload.'; 
	} 
	// dapat pag kung ano lng ung may laman un lag mag update. Problema is inuupdate nya ung wlang laman kaya nagiging null
	if($prod_id != null && $prod_name != null && $prod_var != null && $prod_cat != null && $prod_quan != 0 && $prod_price != 0)
	{
		//LOG FUNCTION BEGIN
		$insert3="insert into tbl_logs(LOGS_NAME,LOGS_ACTION,LOGS_DATE) 
		values('$prod_user','Updated a Product Named $prod_name',NOW())";
		$conn->query($insert3);
		//LOG FUNCTION END
		$update1="UPDATE tbl_product SET PROD_NAME ='$prod_name' WHERE PROD_ID = '$prod_id'";
		$update2="UPDATE tbl_product SET PROD_VARIANT ='$prod_var' WHERE PROD_ID = '$prod_id'";
		$update3="UPDATE tbl_product SET PROD_QUANTITY ='$prod_quan' WHERE PROD_ID = '$prod_id'";
		$update4="UPDATE tbl_product SET PROD_PRICE ='$prod_price' WHERE PROD_ID = '$prod_id'";
		$update5="UPDATE tbl_product SET PROD_CAT ='$prod_cat' WHERE PROD_ID = '$prod_id'";		
		if (!empty($img)){
			$update6="UPDATE tbl_product SET PROD_IMG ='$img' WHERE PROD_ID = '$prod_id'";
			$conn->query($update6);
		}
		$conn->query($update1);
		$conn->query($update2);
		$conn->query($update3);
		$conn->query($update4);
		$conn->query($update5);
    ?>
        <script>
            alert("UPDATE SUCCESS")
        </script>
    <?php
    header("refresh:0; Admin-Page.php");
	} 
	else
	{
		echo "Please enter valid inputs";
	}
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
	
	//Session
	$prod_user = $_SESSION['name'];
	$prod_pos = $_SESSION['position'];
	//Session end
	if($prod_name != null && $prod_var != null && $prod_cat != null && $prod_quan != 0 && $prod_price != 0)
	{
		if(!empty($_FILES["insertedImage"]["name"])) { 
			// Get file info 
			$fileName = basename($_FILES["insertedImage"]["name"]); 
			$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
			 
			// Allow certain file formats 
			$allowTypes = array('jpg','png','jpeg','gif'); 
			if(in_array($fileType, $allowTypes)){ 
				$image = $_FILES['insertedImage']['tmp_name']; 
				$imgContent = addslashes(file_get_contents($image)); 

				$img = $imgContent;
			}else{ 
				$statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
			} 
		}else{ 
			$statusMsg = 'Please select an image file to upload.'; 
		} 


	$insert="insert into tbl_product(PROD_NAME,PROD_QUANTITY,PROD_PRICE,PROD_VARIANT,PROD_CAT,PROD_IMG) 
	values('$prod_name','$prod_quan','$prod_price','$prod_var','$prod_cat','$img')";
	$conn->query($insert);
	//LOG FUNCTION BEGIN
		$insert3="insert into tbl_logs(LOGS_NAME,LOGS_ACTION,LOGS_DATE) 
		values('$prod_user','Added a Product Named $prod_name',NOW())";
		$conn->query($insert3);
	//LOG FUNCTION END
    ?>
        <script>
            alert("ADD SUCCESS")
        </script>
    <?php
    header("refresh:0; Admin-Page.php");

	} 
	else
	{
		echo "Please enter valid inputs";
	}
}
//ADD PRODUCT FUNCTION END


?>
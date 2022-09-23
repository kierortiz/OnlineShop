
<?php
// Initialize the session
// session_start();
 
// // Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
// {
//     // Redirect to Home page
//     header("Location: 404.html");
//     exit;
// }
    include "db_conn.php";

    if(isset($_POST['LogSubmit']))
    {
        $user=$_POST['username'];
        $pass=$_POST['password'];

        $view="SELECT * FROM tbl_account WHERE ACC_USER='$user' && ACC_PASS='$pass'";

        $result=$conn->query($view); //or die($conn->error);
        if ($result->num_rows>0)
        {
        //Fecthing Data From AccountDB for Admin
            $found = mysqli_fetch_array($result);
            $uname=$found['ACC_FNAME'];
            // $upass=$found['ACC_PASS'];
            $uposition=$found['ACC_POSITION'];
            if($uposition=="Employee" || $uposition=="Administrator")
            {   //Admin/Employee
                ?>
                   <script>
                    alert("Welcome To Admin Page")
                   </script>
                <?php
                // Password is correct, so start a new session
                session_start();

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $user;
                $_SESSION["name"] = $uname;          
                $_SESSION["position"] = $uposition;   

                $logs="INSERT INTO tbl_logs(LOGS_NAME, LOGS_ACTION, LOGS_DATE) VALUES ('$uname','$uposition Just Login',NOW())";
                $conn->query($logs);
                    
                //Redirect to Admin Page
                header("refresh:0; Admin/Admin-Page.php");
            }
            else
            {	//User/Costumer
                ?>
                   <script>
                    alert("Your now Login")
                   </script>
                <?php
                // Password is correct, so start a new session
                session_start();

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $user;
                $_SESSION["name"] = null;          
                $_SESSION["position"] = null;      
                
                // $logs="INSERT INTO tbl_logs(ACTION,DATE) VALUES('$uname Costumer Just Log in',NOW())";
                // $conn->query($logs);
                    
                //Redirect to Home Page

                header("refresh:0; Home.php");
            }
        }
        else
        {
            ?>
                <script>
                    alert("Username and/or Password incorrect. \nTry again.")
                </script>
            <?php
                header("refresh:0; Home.php#open-login");
        }
    }
    // else{echo "Error: $sql".$conn->error;}
?>
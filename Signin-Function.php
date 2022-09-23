
<?php
    include "db_conn.php";

    if(isset($_POST['SignSubmit']))
    {
        $user1=$_POST['suser'];
        $pass1=$_POST['spass'];
        $pass2=$_POST['pass1'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $cont=$_POST['cont'];

        if($pass1==$pass2)
        {        
            $view="SELECT * FROM tbl_account WHERE ACC_USER='$user1'";
            $result=$conn->query($view);

            $row = $result->fetch_array();

            if ($result->num_rows>0)
            {
                if($user1==$row['ACC_USER'])
                {
                ?>
                    <script>
                       alert("Username Already Taken")
                    </script>
                    <?php
			        //Redirect to the Page
			        header("refresh:0; Home.php#open-signin");
                }        
            }
            else
            {
                ?>
                    <script>
                      alert("Successfull Signed Up")
                    </script>
                <?php
                $ins="INSERT INTO tbl_account(ACC_USER,ACC_PASS,ACC_FNAME,ACC_LNAME,ACC_CONTACT)values('$user1','$pass1','$fname','$lname',$cont)";
                $conn->query($ins);
   
                //Costumer
                // Password is correct, so start a new session
                session_start();
            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $user1; 
                $_SESSION["name"] = null;          
                $_SESSION["position"] = null; 
                   
                //Redirect to the Page
			    header("refresh:0; Home.php");
            }
        }
        else
        {
            ?>
            <script>
            alert("Password does not match")
            </script>
            <?php    
			    //Redirect to the Page
			    header("refresh:0; Home.php#open-signin");
        }
    }
?>
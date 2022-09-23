<html>
    <title>Change Password</title>
        <body>
            <center><br><br><h1>Change Password</h1>
                <form method=POST action="cpass.php">
                            <div class ="input">
                                    <label class="sign">OLD PASSWORD</label>
                                    <input type="password" name="opass" placeholder="password" ><br><br>

                                    <label class="sign">NEW PASSWORD</label>
                                    <input type="password" name="npass"  placeholder="password" ><br><br>

                                    <label class="sign">RETYPE PASSWORD</label>
                                    <input type="password" name="rpass1"   placeholder="check password" ><br><br>
                                    
                                    <label class="sign">CONTACT NUMBER</label>
                                    <input type="text" name="cont"  placeholder="09*********"><br><br>
                                    <input type="submit" name="submit" value="Change Password">
                            </div>
                </form>         
          </center>
        </body>
</html>
<?php
include "db_conn.php";



if(isset($_POST['submit']))
{
$opass=$_POST['opass'];
$npass=$_POST['npass'];
$rpass1=$_POST['rpass1'];
$cont=$_POST['cont'];
 
       
        $view="SELECT * FROM tbl_account WHERE ACC_USER='user1'";
        $result=$conn->query($view);
        $row = $result->fetch_array();

        if ($result->num_rows>0)
        {
            
            if($opass!=$row['ACC_PASS'])
            {
                 ?>
                <script>
                alert("Wrong Password")
                </script>
                <?php
                if($npass!=$rpass1)
                {
                    ?>
                       <script>
                       alert("New password does not match with retyped password")
                       </script>
                       <?php
                       
                }
            }
            else
            {
                $up= "UPDATE tbl_account SET ACC_PASS ='$rpass1' WHERE ACC_USER ='user1'";
                $result=$conn->query($up);
                if($result==true)
                {
                    ?>
                    <script>
                    alert("Password Changed")
                    </script>
                    <?php
                     header("refresh:1; profile.php");
                }
            }
            
        }
        else
        {
        echo"0 results";
           
        }
    
  

    
}









?>
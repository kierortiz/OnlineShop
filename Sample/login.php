<html>
    <title>Blessed Login</title>
   
    <body>
    <br><br><br>
    <form method=POST action=login.php>
    <center>
        <h1>LOGIN</h1>
            <div class ="input">                          
                <img src="logolog.png" style="width:150px; height:150px;"><br>
                <label class="user" >Username</label><br>
                <input type="text" name="username" required autofocus>
                <br>
                <label class="user">Password</label><br>
                <input type= "password" name="password" required>
                <br>
                <input type= "submit"  name="submit" value="Login" class="btn"><br>
                <a href="signup.php">Create account</a>&nbsp
            </div>
    </center>
    </form>
    </body>
</html>

<?php
include "db_conn.php";

if(isset($_POST['submit']))
{
$user=$_POST['username'];
$pass=$_POST['password'];
    
$view="SELECT * FROM tbl_account WHERE ACC_USER='$user' && ACC_PASS='$pass'";

$result=$conn->query($view);

if ($result->num_rows>0)
    {       
        header("location: home.php");   
    }
    else
    {
    ?>
        <script>
         alert("Wrong credentials")
        </script>
    <?php
    }
}
?>
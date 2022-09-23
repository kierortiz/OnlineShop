<html>
    <title>Sign-up</title>
        <body>
            <center><br><br><h1>CREATE YOUR ACCOUNT</h1>
                <form method=POST action="signup.php">
                            <div class ="input">
                                <label class="sign">USERNAME</label>
                                <input type="text" name="user" required autofocus placeholder="username"><br><br>

                                <label class="sign">PASSWORD</label>
                                <input type="password" name="pass" required placeholder="password" ><br><br>

                                <label class="sign">RETYPE PASSWORD</label>
                                <input type="password" name="pass1" required  placeholder="check password" ><br><br>
                                    
                                <label class="sign">FIRST NAME</label>
                                <input type="text" name="fname" required  placeholder="first name" ><br><br>

                                <label class="sign">LAST NAME</label>
                                <input type="text" name="lname" required  placeholder="last name"><br><br>
                                    
                                <label class="sign">CONTACT NUMBER</label>
                                <input type="text" name="cont" required placeholder="09*********"><br><br>
                                <input type="submit" name="submit" value="Create account">
                    </div>
                </form>         
          </center>
        </body>
</html>

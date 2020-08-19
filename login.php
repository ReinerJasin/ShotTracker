<!DOCTYPE html>

<?php
    //memulai session
    session_start();

    //implement config
    include_once("config.php");
?>

<html>

<head>
    <title>Shoot Track - Know your 3 point spot!</title>
    <link rel="stylesheet" href="home.css">
</head>
    <body>
        <div id="al">
            <h1>Login</h1>
            <form action="redirect.php" method="POST">
                <input type="text" name="user"  placeholder="Username" required><br><br>
                <input type="password" name="pass"  placeholder="Password" required><br><br>
                
                <?php

                if(isset($_SESSION["login"])){
                    if($_SESSION["login"] == "no"){
                        echo 'Username atau Password salah!<br/><br/>';
                    }
                }

                ?>
                
                <button type="submit" id="send">SIGN IN</button>
                <a href="signup.php">Sign up!</a>
            </form>
            
        </div>
       
    </body>
</html>
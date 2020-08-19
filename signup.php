<!DOCTYPE html>

<?php
    //memulai session
    session_start();

    //implement config
    include_once("config.php");
?>

<html>

    <head>
        <link rel="stylesheet" href="home.css">
        <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=Zm4HCRE7wfQbE_AbHs4_9Ubal_QS33a5f4q8oCkqp6Gj2w1fCj2y1lvVu5S-ht0rzX1OyEZ39QGoIIhGDs9ivTTGNn3TFi5DKPQtN6rB3_w6qdHl32r0RgkF1yra3ZhXJMqQUR8noCnszHd1cXqpdQ" charset="UTF-8"></script>
    </head>
    
    <body>
            
        <form action="redirect2.php" method="post">
            
            <div class="container">
              
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p><br>
             
                <input type="text" placeholder="Enter Username" name="user" id="email" required><br><br>
              
                <input type="password" placeholder="Enter Password" name="pass" id="psw" required><br><br>
              
                <input type="password" placeholder="Repeat Password" name="passr" id="psw-repeat" required><br><br>

                <?php

                    if(isset($_SESSION["passr"])){
                        if($_SESSION["passr"] == "no"){
                            echo 'Password yang dimasukkan berbeda!<br/><br/>';
                        }
                    }

                    if(isset($_SESSION["checkuser"])){
                        if($_SESSION["checkuser"] == "no"){
                            echo 'Username tidak tersedia!<br/><br/>';
                        }
                    }

                    if(isset($_SESSION["checkregister"])){
                        if($_SESSION["checkregister"] == "yes"){
                            echo 'Akun Berhasil dibuat!<br/><br/>';
                        }
                    }

                ?>
          
                <button type="submit" class="registerbtn">Register</button>
            
                <p>*Already have an account? <a href="login.php">Sign in</a></p>
            
            </div>
        
        </form>
    
    </body>

</html>
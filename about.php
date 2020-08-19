<!DOCTYPE html>

<?php
    //memulai session
    session_start();

    //implement config
    include_once("config.php");

    if(!isset($_SESSION["user"]) || !isset($_SESSION["pass"])){
        header("Location:login.php");
    }
    
?>
    
<html>

    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        
        <div id="header">
            
            <h1>shootTracker</h1>
            
            <div id="nav">
                <ul>
                    <li ><a href="index.php">Home</a></li>
                    <li><a href="insight.php">Insight</a></li>
                    <li ><a href="add.php">Add Data</a></li>
                    <li class="active"><a href="about.php">About</a></li>
                    <li id="user"><a href="index.php">Welcome <?php echo $_SESSION["user"];?></a></li>
                </ul>

            </div>

            <div id="word">
                <h1>Welcome,</h1>
                <p>to ShotTracker, we believe everyone WANTS to know their zone. Our goal is to track and provide you with ACCURATE DATA about your SHOOTING ZONE. We're excited to help you on your journey!</p>
            </div>

            <h1>Tap the ball to send email !</h1>
            
            <div id="email">
              <a href="mailto:jwilliam@student.ciputra.ac.id"><img src="image/email.png"></a> 
              <a href="mailto:ranggriawan@student.ciputra.ac.id"><img src="image/email1.png"></a> 
            </div>

            <div id="footer">

                <p>© Copyright shootTracker. All Right Reserved</p>

            </div>

        </div>
    
    </body>

</html>
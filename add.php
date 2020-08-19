<!DOCTYPE html>

<?php
    // Memulai Session
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
        <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=6PsXRJVr7IorAcRLdQgXaUNLcHPbcWjpunSoQfnG9jJXmX83XKJ8AxI5mkcZhHHDPnhQeAtAxKYOk0iNLU8TK626Hqgt9NTArkHLkt-yGa9DxcXRQmOzmgOK8YSk8_qItG_nIA2XL0jKn9tLbUKcQQ" charset="UTF-8"></script>
    </head>

    <body>
        <div id="header">

            <h1>shootTracker</h1>

            <div id="nav">

                <ul>
                    <li ><a href="index.php">Home</a></li>
                    <li><a href="insight.php">Insight</a></li>
                    <li class="active"><a href="add.php">Add Data</a></li>
                    <li><a href="about.php">About</a></li>
                    <li id="user"><a href="index.php">Welcome <?php echo $_SESSION["user"];?></a></li>
                </ul>
                
            </div>

            <div id="insert">

                <h1>Player Form</h1>

                <form action="redirect3.php" method="post" name="form1">

                           <input type="text" name="player" placeholder="Player Name" required><br/><br/>
                        
                            <select name="spot" >
                                <option value="Left Corner">Left Corner</option>
                                <option value="Left Wing">Left Wing</option>
                                <option value="Middle">Middle</option>
                                <option value="Right Wing">Right Wing</option>
                                <option value="Right Corner">Right Corner</option>
                            </select>

                            <br/><br/>
                    
                           <input type="number" name="made" placeholder="Shoot Made" required><br/><br/>
                         
                            <input type="number" name="attempt" placeholder="Shoot Attempt" required><br/><br/>

                        <input type="submit" name="Submit" value="Add Data">
                        <p>*Shoot in all spots for more precise detail !</p>

                </form>

            </div>

    </body>

</html>
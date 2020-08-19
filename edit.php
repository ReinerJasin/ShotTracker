<!DOCTYPE html>

<?php

    // Memulai Session
    session_start();

    //implement config
    include_once("config.php");

    if(!isset($_SESSION["user"]) || !isset($_SESSION["pass"])){
        header("Location:login.php");
    }

    $id = $_GET["id"];
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE player_id = $id");

    while($user_data = mysqli_fetch_array($result)){
        $name = $user_data["player_name"];
        $spot = $user_data["player_spot"];
        $made = $user_data["3pt_made"];
        $attempt = $user_data["3pt_attempt"];
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
                    <li class="active"><a href="insight.php">Insight</a></li>
                    <li><a href="add.php">Add Data</a></li>
                    <li><a href="about.php">About</a></li>
                    <li id="user"><a href="index.php">Welcome <?php echo $_SESSION["user"];?></a></li>
                </ul>
                
            </div>

            <div id="insert">

                <h1>Player Form</h1>

                <form action="redirect4.php" method="post" name="form1">

                    <input type="text" name="player" placeholder="Player Name" value="<?php echo $name;?>" required><br/><br/>
                        
                    <?php

                        $spots = ["Left Corner", "Left Wing", "Middle", "Right Wing", "Right Corner"];

                    ?>

                    <select name="spot">

                        <?php

                            for($x = 0; $x < count($spots); $x++){

                                if($spots[$x] == $spot){
                                    echo '<option value="'.$spots[$x].'" selected>'.$spots[$x].'</option>';
                                }else{
                                    echo '<option value="'.$spots[$x].'">'.$spots[$x].'</option>';
                                }

                            }

                        ?>

                    </select>

                    <br/><br/>
                    
                    <input type="number" name="made" placeholder="Shoot Made" value="<?php echo $made;?>" required><br/><br/>
                         
                    <input type="number" name="attempt" placeholder="Shoot Attempt" value="<?php echo $attempt;?>" required><br/><br/>

                    <input type="hidden" name="id" value="<?php echo $id;?>">

                    <input type="submit" name="Submit" value="Save">

                    <form action="insight.php" method="post" name="back">

                        <input type="submit" name="submit" value="cancel">

                    </form>

                    <p>*Shoot in all spots for more precise detail !</p>

                </form>

            </div>

    </body>

</html>
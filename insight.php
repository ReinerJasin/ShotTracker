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
        <title>Shoot Track - Know your 3 point spot!</title>
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=OwDQEMoXiPfXnXfgon--WmiADAqFwcqI1jwoOumZLUWW07RtzRgLJHF_IzjI9vYb6Xj0VJD_UDM1nbZfOVZtDFXxXrDoMT5YXuBFEotz1Kj5tr96BMn_-qqj0wKQmq91-swe4aTdqco49CJnAMoYzw" charset="UTF-8"></script>
    </head>

    <body>

    <div id="header">

        <h1>shootTracker</h1>
            
        <div id="nav">
                
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="insight.php">Insight</a></li>
                <li><a href="add.php">Add Data</a></li>
                <li><a href="about.php">About</a></li>
                <li id="user"><a href="index.php">Welcome <?php echo $_SESSION["user"];?></a></li>
            </ul>
                
        </div>

    </div>
    
    <?php

    $user = $_SESSION["user"];

    //Memasukkan hasil select distinct ke array untuk dropdown
    $result = mysqli_query($mysqli, "SELECT DISTINCT player_name FROM users, account WHERE users.coach_id = account.coach_id AND account.coach_name = '$user'");

    //Inisialisasi array untuk dropdown
    $dropdown = array('All');

    while($user_data = mysqli_fetch_array($result)) {        
        array_push($dropdown, $user_data['player_name']);
    }

    //memasukkan array ke dalam session
    $_SESSION["dropdown"] = $dropdown;

    //mengecek apakah ada filter yang sedang aktif
    if(isset($_POST["filters"])){
        $filters = $_POST["filters"];
    }else{
        $filters = 'All';
    }

    ?>

    <br/>

    <form action="insight.php" method="POST">

        <select name="filters">
        
            <?php

                //mengoutput dropdown
                for($x = 0; $x < count($dropdown); $x++){

                    //mengecek apakah ada filter yang sedang aktif
                    if($dropdown[$x] == $filters){
                        echo '<option value="'.$dropdown[$x].'" selected>'.$dropdown[$x].'</option>';
                    }else{
                        echo '<option value="'.$dropdown[$x].'">'.$dropdown[$x].'</option>';
                    }
                
                }

            ?>

        </select>

        <input type="submit" name="Submit" value="Refresh">

    </form>

    <?php

    if($filters == 'All'){
        $result2 = mysqli_query($mysqli, "SELECT * FROM users, account WHERE users.coach_id = account.coach_id AND account.coach_name = '$user' ORDER BY date DESC");
    }else{
        $result2 = mysqli_query($mysqli, "SELECT * FROM users, account WHERE users.coach_id = account.coach_id AND account.coach_name = '$user' AND player_name = '$filters'");
    }
    
    ?>

    <table width='100%' border=1>

    <tr>
    
        <th>Date</th> <th>Player Name</th> <th>Spot</th> <th>3Pt Made</th> <th>3Pt Attempt</th> <th>3Pt Percentage</th> <th>Option</th>

    </tr>

    <?php

        while($user_data = mysqli_fetch_array($result2)) {         
            echo "<tr>";
            echo "<td>".$user_data['date']."</td>";
            echo "<td>".$user_data['player_name']."</td>";
            echo "<td>".$user_data['player_spot']."</td>";
            echo "<td>".$user_data['3pt_made']."</td>";
            echo "<td>".$user_data['3pt_attempt']."</td>";

            //inisialisasi variable average
            $average = 0;

            //menghitung nilai average
            $average = $user_data['3pt_made']/$user_data['3pt_attempt']*100;

            //membulatkan average menjadi 2 digit di belakang koma
            $average = round($average, 2);

            echo "<td>".$average." %</td>";
            echo "<td><a href='edit.php?id=$user_data[player_id]'>Edit</a> | <a href='delete.php?id=$user_data[player_id]'>Delete</a></td></tr>";        
        }

    ?>

</table>
    
    </body>

</html>
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="insight.php">Insight</a></li>
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

        <form action="index.php" method="POST">

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
        //http://localhost/phpmyadmin/tbl_sql.php?db=crud_db&table=users
        //http://localhost/percentage/index.php

        //Cek filter dalam dropdown
        if($filters == 'All'){
            $result2 = mysqli_query($mysqli, "SELECT * FROM users, account WHERE users.coach_id = account.coach_id AND account.coach_name = '$user'");
        }else{
            $result2 = mysqli_query($mysqli, "SELECT * FROM users, account WHERE users.coach_id = account.coach_id AND account.coach_name = '$user' AND player_name = '$filters'");
        }

        //inisialisasi variabel
        $totalMade = 0;
        $totalAttempt = 0;

        $LCmade = 0;
        $LCattempt = 0;

        $LWmade = 0;
        $LWattempt = 0;

        $Mmade = 0;
        $Mattempt = 0;

        $RWmade = 0;
        $RWattempt = 0;

        $RCmade = 0;
        $RCattempt = 0;

        //Mengtotal semua 3pt made dan attempt ke dalam variabel
        while($user_data = mysqli_fetch_array($result2)) {   
                    
            $totalMade += $user_data['3pt_made'];
            $totalAttempt += $user_data['3pt_attempt'];

            if($user_data['player_spot'] == 'Left Corner'){
                $LCmade += $user_data['3pt_made'];
                $LCattempt += $user_data['3pt_attempt'];
                $LCaverage = $LCmade / $LCattempt;
            }else if($user_data['player_spot'] == 'Left Wing'){
                $LWmade += $user_data['3pt_made'];
                $LWattempt += $user_data['3pt_attempt'];
                $LWaverage = $LWmade / $LWattempt;
            }else if($user_data['player_spot'] == 'Middle'){
                $Mmade += $user_data['3pt_made'];
                $Mattempt += $user_data['3pt_attempt'];
                $Maverage = $Mmade / $Mattempt;
            }else if($user_data['player_spot'] == 'Right Wing'){
                $RWmade += $user_data['3pt_made'];
                $RWattempt += $user_data['3pt_attempt'];
                $RWaverage = $RWmade / $RWattempt;
            }else if($user_data['player_spot'] == 'Right Corner'){
                $RCmade += $user_data['3pt_made'];
                $RCattempt += $user_data['3pt_attempt'];
                $RCaverage = $RCmade / $RCattempt;
            }

        }
            
        //Mencegah error divided by zero pada variabel $average
        if($totalAttempt == '0'){
            $average = 0;
        }else{
            $average = $totalMade / $totalAttempt * 100;
        }

        //Membulatkan ke 2 angka di belakang koma
        $percent = round($average, 2);

        //Mencegah error divided by zero pada average setiap spot
        if(!isset($LCaverage)){
            $LCaverage = 0;
        }
        if(!isset($LWaverage)){
            $LWaverage = 0;
        }
        if(!isset($Maverage)){
            $Maverage = 0;
        }
        if(!isset($RWaverage)){
            $RWaverage = 0;
        }
        if(!isset($RCaverage)){
            $RCaverage = 0;
        }

        //Memasukkan nilai rata rata semua spot ke dalam array lalu di sort dari kecil ke besar
        $minmax = array($LCaverage,$LWaverage,$Maverage,$RWaverage,$RCaverage);
        sort($minmax);

        //mencari spot dengan percentage paling tinggi
        if($minmax[count($minmax)-1] == $LCaverage){
            $best = 'Left Corner';
        }else if($minmax[count($minmax)-1] == $LWaverage){
            $best = 'Left Wing';
        }else if($minmax[count($minmax)-1] == $Maverage){
            $best = 'Middle';
        }else if($minmax[count($minmax)-1] == $RWaverage){
            $best = 'Right Wing';
        }else if($minmax[count($minmax)-1] == $RCaverage){
            $best = 'Right Corner';
        }

        //mencari spot dengan percentage paling rendah
        if($minmax[0] == $LCaverage){
            $worst = 'Left Corner';
        }else if($minmax[0] == $LWaverage){
            $worst = 'Left Wing';
        }else if($minmax[0] == $Maverage){
            $worst = 'Middle';
        }else if($minmax[0] == $RWaverage){
            $worst = 'Right Wing';
        }else if($minmax[0] == $RCaverage){
            $worst = 'Right Corner';
        }

        echo '<div id="zone">';

        //output gambar lapangan
        echo '<img src="image/field1.jpg" class="lapangan">';

        //output left corner zone
        if($best == 'Left Corner'){
            echo '<img src="image/hz.png" class="h">';
        }else if($worst == 'Left Corner'){
            echo '<img src="image/cz.png" class="h">';
        }else{
            echo '<img src="image/nz.png" class="h">';
        }

        //output left wing zone
        if($best == 'Left Wing'){
            echo '<img src="image/hz.png" class="c">';
        }else if($worst == 'Left Wing'){
            echo '<img src="image/cz.png" class="c">';
        }else{
            echo '<img src="image/nz.png" class="c">';
        }

        //output middle zone
        if($best == 'Middle'){
            echo '<img src="image/hz.png" class="g1">';
        }else if($worst == 'Middle'){
            echo '<img src="image/cz.png" class="g1">';
        }else{
            echo '<img src="image/nz.png" class="g1">';
        }

        //output right wing zone
        if($best == 'Right Wing'){
            echo '<img src="image/hz.png" class="g2">';
        }else if($worst == 'Right Wing'){
            echo '<img src="image/cz.png" class="g2">';
        }else{
            echo '<img src="image/nz.png" class="g2">';
        }

        //output right corner zone
        if($best == 'Right Corner'){
            echo '<img src="image/hz.png" class="g3">';
        }else if($worst == 'Right Corner'){
            echo '<img src="image/cz.png" class="g3">';
        }else{
            echo '<img src="image/nz.png" class="g3">';
        }
        
        echo'</div>';

        //Membulatkan ke 2 angka di belakang koma
        $percent1 = round(($minmax[count($minmax)-1] * 100), 2);
        $percent2 = round(($minmax[0] * 100), 2);

    ?>

    <div id="result">
                    
        <ul>
            <li>SHOT PERCENTAGE = <?php echo $percent; ?> %</li> <br>
            <li>TOTAL MADE = <?php echo $totalMade; ?> shots</li>
            <li>TOTAL ATTEMPT = <?php echo $totalAttempt; ?> shots</li><br>
                        
            <?php
            
            echo '<li>BEST ZONE = '.$best.' ('.$percent1.'%)</li>';
            echo '<li>WORST SPOT = '.$worst.' ('.$percent2.'%)</li>';

            ?>
                    
        </ul>

        <h6>*Shoot in all spots for more precise detail !</h6>
            
    </div>

            <div id="detail">
                <a href="insight.php"><p>Check Insight →</p></a>
            </div>

            <div class="w3-content w3-section" style="max-width:100%">
                <img class="mySlides w3-animate-top" src="image/kb.jpg" style="width:100%">
                <img class="mySlides w3-animate-bottom" src="image/mj.jpg" style="width:100%">
                <img class="mySlides w3-animate-top" src="image/lj.jpg" style="width:100%">
                <img class="mySlides w3-animate-bottom" src="image/jh.jpg" style="width:100%">
                <img class="mySlides w3-animate-bottom" src="image/sc.jpg" style="width:100%">
            </div>

            <script>
                var myIndex = 0;
                carousel();
                
                function carousel() {
                  var i;
                  var x = document.getElementsByClassName("mySlides");
                  for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                  }
                  myIndex++;
                  if (myIndex > x.length) {myIndex = 1}    
                  x[myIndex-1].style.display = "block";  
                  setTimeout(carousel, 2500);    
                }
            </script>


    </body>

</html>
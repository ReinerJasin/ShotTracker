<!DOCTYPE html>

<?php
    //memulai session
    session_start();

    //implement config
    include_once("config.php");

    if(!isset($_SESSION["user"]) || !isset($_SESSION["pass"])){
        header("Location:login.php");
    }

    //inisialisasi user dan coach id
    $player = $_POST["player"];
    $spot = $_POST["spot"];
    $made = $_POST["made"];
    $attempt = $_POST["attempt"];
    $coach = $_SESSION["coach_id"];
    echo $coach;
    
    $result = mysqli_query($mysqli, "INSERT INTO users(player_id, date, player_name, player_spot, 3pt_made, 3pt_attempt, coach_id) VALUES(null,current_timestamp,'$player','$spot','$made','$attempt','$coach')");

    //Redirect
    header("Location:insight.php");

?>

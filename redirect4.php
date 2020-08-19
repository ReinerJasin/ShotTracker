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
    $id = $_POST["id"];
    $player = $_POST["player"];
    $spot = $_POST["spot"];
    $made = $_POST["made"];
    $attempt = $_POST["attempt"];

    $result = mysqli_query($mysqli, "UPDATE users SET player_name='$player', player_spot='$spot', 3pt_made='$made', 3pt_attempt='$attempt' WHERE player_id=$id");

    //Redirect
    header("Location:insight.php");

?>

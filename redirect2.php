<!DOCTYPE html>

<?php
    //memulai session
    session_start();

    //implement config
    include_once("config.php");

    //menerima data dari form
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $passr = $_POST["passr"];

    //cek password dan password repeat
    if($pass != $passr){
        $_SESSION["passr"] = "no";
        header("Location:signup.php");
    }else{
        $_SESSION["passr"] = "yes";
    }

    $result = mysqli_query($mysqli, "SELECT * FROM account");

    while($user_data = mysqli_fetch_array($result)) {

        //cek kalau username masih tersedia
        if($user == $user_data["coach_name"]){

            // username tidak tersedia
            $_SESSION["checkuser"] = "no";
            header("Location:signup.php");
        
        }else{

            // username tersedia
            $_SESSION["checkuser"] = "yes";
        
        }
    }

    //cek kalau akun dapat dibuat
    if($_SESSION["passr"] == "no" || $_SESSION["checkuser"] == "no"){
        $register = "no";
    }else{
        $register = "yes";
    }

    //membuat akun
    if($register == "yes"){

        $result2 = mysqli_query($mysqli, "INSERT INTO account(coach_id, coach_name, coach_password) VALUES(null, '$user', '$pass')");
        $_SESSION["checkregister"] = "yes";

        //redirect ke signup.php
        header("Location:signup.php");
        
    }

?>

<html>

<head>
    <title>Shoot Track - Know your 3 point spot!</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
       
</body>

</html>

<!DOCTYPE html>

<?php
    //memulai session
    session_start();

    //implement config
    include_once("config.php");

    $user = $_POST["user"];
    $pass = $_POST["pass"];
    
    $result = mysqli_query($mysqli, "SELECT * FROM account");

    while($user_data = mysqli_fetch_array($result)) {

        if($user == $user_data["coach_name"] && $pass == $user_data["coach_password"]){

            // login berhasil
            $_SESSION["login"] = "yes";

            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            $_SESSION["coach_id"] = $user_data["coach_id"];

            break;
        
        }else{

            // login gagal
            $_SESSION["login"] = "no";
        
        }

    }

    //Redirect
    if($_SESSION["login"] == "yes"){

        // redirect ke index
        header("Location:index.php");

    }else{

        // redirect ke login form
       header("Location:login.php");

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

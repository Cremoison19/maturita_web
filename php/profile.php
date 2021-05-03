<?php
session_start();
if(isset($_SESSION['logged'])){
    if($_SESSION['logged']==false){
        header("Location:/php/login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>

<body>
    <?php
        if(isset($_SESSION)){
            if($_SESSION['logged']==false and !isset($_SESSION['user'])){
                echo("Per accedere a questa schermata devi avere un account.<br>");
                echo("<a href='signup.php'>Registrati</a><br>");
                echo("<a href='login.php'>Accedi</a>");
            }
        }

        /*if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])){
            echo "owo";
            $_SESSION['logged']=false;
            unset($_SESSION['user']);
            echo "logged out.";
        }*/

    ?>
    <center>
    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    </center>
</body>

</html>
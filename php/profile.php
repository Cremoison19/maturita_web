<?php
session_start();
if(isset($_SESSION['logged'])){
    if($_SESSION['logged']==false){
        session_destroy();
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
        echo "User: ".$_SESSION['user'];
        

    ?>
    <center>
    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    </center>
</body>

</html>
<?php
session_start();
if(isset($_SESSION['logged'])){
    if($_SESSION['logged']==false){
        session_destroy();
        header("Location:/php/error_login.php");
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

<body
    <h2>Profile</h2>
    <?php
        if(isset($_SESSION)){
            if($_SESSION['logged']==false and !isset($_SESSION['user'])){
                
            }
        }
        echo "User: ".$_SESSION['user'];        
    ?>
    <center>
    <form method="POST" action="login.php">
        <!-- 
            name, surname, day of birth, birth place, change email, change password
            upload curriculum vitae
            redirect to page where to look up for current jobs available
            send an email to 
        -->
        
        <input type="submit" name="logout" value="Logout">
    </form>
    </center>
</body>

</html>
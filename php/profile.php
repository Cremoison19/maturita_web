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

<body>
    <h2>My Profile</h2>
    <?php
        $_SESSION['nodata'] = false;
        $id = $_SESSION['userID'];
        $sql = $result = null;
        // IF USER DATA IS EMPTY, GO TO MODIFY USER DATA
        require_once "config.php";
        $sql = "SELECT name FROM users WHERE id = '$id'";
        $result = $pdo->query($sql)->fetch();
        if($result['name'] == null){
            echo ":/";
            $_SESSION['nodata'] = true;
            header("Location:/php/edit_profile.php");
        }

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

    <footer>
        <?php
            echo "User: ".$_SESSION['userEmail']."<br>";
            echo "ID: ".$_SESSION['userID']."<br>";
        ?>
    </footer>
</body>

</html>
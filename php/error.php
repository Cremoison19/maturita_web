<!-- error page that appears when user is not logged, but trying to get into profile page
-->

<?php
session_start();
if(isset($_SESSION['logged'])){
    if($_SESSION['logged']==true){
        header("Location:/php/profile.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uh oh...</title>
</head>
<body>
    
    <h2>Uh oh...</h2>
    <p>To view your profile, you need to register one, or login if you already have it.</p>
    <button onclick="window.location.href = 'login.php';">Login</button>
    <button onclick="window.location.href = 'signup.php';">Signup</button>


</body>
</html>
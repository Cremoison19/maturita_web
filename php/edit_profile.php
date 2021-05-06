
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Infos</title>
</head>

<body>
    <center>
    <h2>Edit Profile</h2>

<?php
    // file con impostazioni del database
    require_once "config.php";

    // variabili istanziate vuote
    $name = $surname = $birthday = $birthplace = null;
    $email = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $validate = true;

        if($_SESSION['nodata'] && (isset($_POST['name'])==false || isset($_POST['surname'])==false || !isset($_POST['birthday'])==false ||!isset($_POST['birthplace'])==false)){
            echo "Non hai inserito tutti i dati, fai attenzione!";
        }
        else{
            // $email = $_POST['email'];
            if(isset($_POST['name'])) $name = $_POST['name'];
            if(isset($_POST['surname'])) $name = $_POST['surname'];
            if(isset($_POST['birthday'])) $name = $_POST['birthday'];
            if(isset($_POST['name'])) $name = $_POST['name'];
        }

    }

?>


    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Name</label>
        <input name="name" placeholder="Your name" maxlenght="32"><br>
        <label for="surname">Surname</label>
        <input name="surname" placeholder="Your surname" maxlenght="32"><br>
        <label for="birthday">Birthday</label>
        <input name="birthday" type="date"><br>
        <label for="birthplace">Surname</label>
        <input name="birthplace" placeholder="Where were you born?" maxlenght="32"><br>

        <br>

        <label for="email">Email</label>
        <input name="email" placeholder="Change email" maxlenght="320"><br>
        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Change password" maxlenght="255"><br>
        
        <br>

        <input type="submit" value="Save"><br>
        
        <a href="profile.php">Back to profile</a><br>

    </form>
</center>
</body>
</html>
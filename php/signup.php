<?php
session_start();
if(isset($_POST['logout'])) $_SESSION['logged'] = false;
if($_SESSION['logged']==true){
    header("Location:/php/profile.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
</head>

<body>

<?php

    $emailErr = $passwordErr = "";
    
    // file con impostazioni del database
    require_once "config.php";

    // variabili istanziate vuote
    $email = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $validate = true;

        // ottenimento valori dal form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // controllo valori inseriti 

        if (empty($_POST["email"])) {
            $emailErr = "L'email è obbligatoria";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = $demailErr;
                $validate = false;
            }
        }

        if (empty($_POST["password"])) {
            $password = "La password è obbligatoria";
        } else {
            if(strlen($password)<=$PWD_MIN_LENGTH){
                $passwordErr = $dpasswordErr;
                $validate = false;
            }
        }

        // query (solo se tutti i campi sono stati validati)
        if($validate){

            // se la validazione è avvenuta correttamente e quindi la password è corretta, possiamo criptarla prima di inserirla nel database
            $password_c = cryptp($password);

            $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password_c');";

            if ($pdo->query($sql) === TRUE) {
                $_SESSION['logged'] = true;
                $_SESSION['user'] = $email;
            }

        }
        else{
            echo "La validazione ha riscontrato degli errori";
        }

    }

?>

    <center>
    <h2>Registrati</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <a href="index.php">Torna alle homepage</a><br>
        <label for="email">Email</label>
        <input name="email" placeholder="Email" required maxlenght="320">
        <span><?php echo $emailErr;?>* </span><br>
        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Password" required maxlenght="255">
        <span><?php echo $passwordErr;?>* </span><br>
        <input type="submit" value="Registrati">
    </form>
    <a href="login.php">Login</a>
    </center>

</body>

</html>
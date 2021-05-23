<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <?php
    // file con impostazioni del database
    require_once "config.php";

    // variabili istanziate vuote
    $email = $password = "";
    $emailErr = $passwordErr = "";

    // variabili globali

    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])) {
        $validate = true;
        // ottenimento valori dal form
        $email = $_POST['email'];
        $password = $_POST['password'];
        unset($_POST['logout']);
        $_SESSION['logged'] = false;
        if ($validate) {
            $password = cryptp($password);
            $result = $sql = "";
            // NORMAL USER 
            $sql = "SELECT count(email) FROM users WHERE email='$email'";
            $result = $pdo->query($sql)->fetch();
            if ($result[0] > 0) {
                //echo 'normal user';
                $sql = "SELECT password FROM users WHERE email = '$email'";
                $result = $pdo->query($sql)->fetch();
                // password check
                if ($password == $result["password"]) {
                    // if pwd is ok, continue logging in 
                    $_SESSION['logged'] = true;
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    // save user data in session
                    $_SESSION['userdata'] = $pdo->query($sql)->fetchAll()[0];
                    // save user id too
                    $_SESSION['userid'] = $_SESSION['userdata']['id'];
                    // save usertype 
                    $_SESSION['usertype'] = 0;
                    // redirect to profile page
                    echo '<script>window.location = "profile.php" </script>';
                    exit;
                } else $passwordErr = $dpasswordErr;
            }

            // CONSULENT USER
            $sql = "SELECT count(email) FROM consulents WHERE email = '$email'";
            $result = $pdo->query($sql)->fetch();

            if ($result[0] > 0) {
                $sql = "SELECT password FROM consulents WHERE email='$email'";
                $result = $pdo->query($sql)->fetch();
                if ($password == $result["password"]) {
                    // save user id too
                    $_SESSION['logged'] = true;
                    $sql = "SELECT * FROM consulents WHERE email = '$email'";
                    // save user data in session
                    $_SESSION['userdata'] = $pdo->query($sql)->fetchAll()[0];
                    // save user id too
                    $_SESSION['userid'] = $_SESSION['userdata']['id'];
                    // save usertype 
                    $_SESSION['usertype'] = 1;

                    // redirect to consulent page
                    echo '<script>window.location = "consulent/consulent.php" </script>';
                    exit;
                }
            }
            // ADMIN USER
            $sql = "SELECT count(email) FROM admins WHERE email='$email'";
            $result = $pdo->query($sql)->fetch();
            if ($result[0] > 0) {
                $sql = "SELECT password FROM admins WHERE email = '$email'";
                $result = $pdo->query($sql)->fetch();
                if ($password == $result["password"]) {
                    // save user id too
                    $sql = "SELECT id FROM admins WHERE email = '$email'";
                    $result = $pdo->query($sql)->fetch();

                    $_SESSION["logged"] = true;
                    $_SESSION["userid"] = $result["id"];
                    $_SESSION["usertype"] = 2;

                    // redirect to admin page   
                    echo "<script>window.location = 'admin/admin.php' </script>";
                    exit;
                }
            } else $emailErr = $demailErr;
        } else {
            echo "La validazione ha riscontrato degli errori";
        }
    }

    ?>

    <center>
        <h2>Login</h2>
        <a href="index.php">Torna alle homepage</a>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <legend for="email">Email</legend>
            <input name="email" type="email"><br>
            <span><?php echo $emailErr; ?></span><br>
            <legend for="password">Password</legend>
            <input name="password" type="password"><br>
            <span><?php echo $passwordErr; ?></span><br><br><br>
            <input name="login" type="submit" value="Accedi">
            <br><br>
            <a href="signup.php">Registrati</a>
        </form>
    </center>
</body>

</html>
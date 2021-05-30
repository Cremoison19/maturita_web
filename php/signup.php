<?php
session_start();
$_SESSION['logged'] = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" type="media" href="style.css">
    <title>Sign-up</title>
</head>

<body>

    <?php
    // file con impostazioni del database
    require_once "config.php";
    // variabili istanziate vuote
    $email = $password = $name = $surname = $birthday = $birthplace = $profession = "";
    $emailErr = $passwordErr = $nameErr = $surnameErr = $birthdayErr = $birthplaceErr = $professionErr = "";

    $year = 31556926;

    // dopo premuto bottone
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // registration into database

        $validate = true;
        $registered = false;

        // ottenimento valori dal form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // controllo valori inseriti 
        $profession = $_POST["profession"];
        if (empty($_POST["email"])) {
            $emailErr = "L'email è obbligatoria";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = $demailErr;
                $validate = false;
            } else if ($pdo->query("SELECT id FROM requests WHERE email='$email'")->fetchAll() != null) {
                $emailErr = "User already pending request of registration. Try to login.";
                $validate = false;
            } else if ($pdo->query("SELECT id FROM users WHERE email='$email'")->fetchAll() != null) {
                $emailErr = "User already registered. Try to login.";
                $validate = false;
            } else $email = $_POST['email'];
        }

        if (empty($_POST["password"])) {
            $password = "La password è obbligatoria";
        } else {
            if (strlen($password) <= $PWD_MIN_LENGTH) {
                $passwordErr = $dpasswordErr;
                $validate = false;
            } else $email = $_POST['email'];
        }
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
                $validate = false;
            } else $name = $_POST['name'];
        }
        if (empty($_POST["surname"])) {
            $nameErr = "Surname is required";
        } else {
            $surname = test_input($_POST["surname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
                $surnameErr = "Only letters and white space allowed";
                $validate = false;
            } else $surname = $_POST['surname'];
        }
        if (empty($_POST["birthplace"])) {
            $birthplaceErr = "Birthplace is required";
        } else {
            $birthplace = test_input($_POST["birthplace"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $birthplace)) {
                $birthplaceErr = "Only letters and white space allowed";
                $validate = false;
            } else $birthplace = $_POST['birthplace'];
        }
        if (empty($_POST["birthday"])) {
            $birthdayErr = "Birthday is required";
            $validate = false;
        } else $birthday = $_POST['birthday'];
        if (empty($_POST["birthday"])) {
            $birthdayErr = "Birthday is required";
            $validate = false;
        } else $birthday = $_POST['birthday'];


        // query (solo se tutti i campi sono stati validati)
        if ($validate == true) {
            try {
                // crypting password before inserting it in db
                $password_c = cryptp($password);

                $registered = true;
                $sql = "INSERT INTO requests (email, password, name, surname, birthday, birthplace, profession) 
                VALUES ('$email', '$password_c', '$name', '$surname', '$birthday', '$birthplace', '$profession');";

                if ($pdo->query($sql) == TRUE) {
                    echo 'Registration request received, when it will be accepted you ';
                }
            } catch (Exception $e) {
                if ($e->getCode() == 23000) {
                    echo $e;
                    $registered = false;
                }
            }

            // if registration is ok, upload curriculum
            if ($registered) {
                $f = opendir("../uploads");
                $dirs = array();
                while (($entry = readdir($f)) !== false) {
                    array_push($dirs, $entry);
                }

                $file = $_FILES['file'];

                $fileName = $file['name'];
                $fileTmp = $file['tmp_name'];
                $fileError = $file['error'];
                $fileSize = $file['size'];

                if (!(in_array($email, $dirs) !== false)) {
                    // check file
                    if (strpos(strtolower($fileName), ".pdf") === false) echo "File extension not allowed.<br/><br/>";
                    else if (intval($fileSize / 1024) > 1024) echo "File is too large (Max 1MB)<br><br>";
                    else {
                        $fileDest = '../uploads/' . $email . ".pdf";
                        rename($fileTmp, $fileDest);
                        // echo "File uploaded.";
                    }
                }
            }
        }
    }

    ?>

    <div class="container pt-3 pb-4 text-center text-white">
        <div class="card login mx-auto">
            <div class="card-header">
                <h2>Sign-up</h2>
                <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <a href="index.php">Torna alle homepage</a><br>
                    <a href="login.php">Login</a>
            </div>
            <div class="card-body">
                <label for="email">Email</label>
                <input name="email" placeholder="Email" maxlenght="320" required>
                <span><?php echo $emailErr; ?>* </span><br>
                <label for="password">Password</label>
                <input name="password" type="password" placeholder="Password" maxlenght="255" required>
                <span><?php echo $passwordErr; ?>* </span><br><br>

                <label for="name">Name</label>
                <input name="name" placeholder="Your name" maxlenght="32" required>
                <span><?php echo $nameErr; ?>* </span><br>

                <label for="surname">Surname</label>
                <input name="surname" placeholder="Your surname" maxlenght="32" required>
                <span><?php echo $surnameErr; ?>* </span><br>

                <label for="birthday">Birthday</label>
                <input name="birthday" type="date" required>
                <span><?php echo $birthdayErr; ?>* </span><br>

                <label for="birthplace">Birthplace</label>
                <input name="birthplace" placeholder="Where were you born?" maxlenght="32" required>
                <span><?php echo $birthplaceErr; ?>* </span><br>

                <select name="profession" class="custom-select-sm">
                    <?php
                    $sql = "SELECT * FROM professions;";
                    $result = $pdo->query($sql);

                    foreach ($result as $row) {
                        $row = $row[0];
                        echo "<option value=\"$row\">$row</option>";
                    }

                    ?>
                </select><br><br>
                <div class="custom-file">
                    <label class="custom-file-label" for="file">Upload your curriculum vitae</label>
                    <input class="custom-file-input" type="file" name="file" accept="application/pdf" required>
                </div>
                <br><br>

                <input type="submit" value="Registrati"><br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
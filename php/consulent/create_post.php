<?php
session_start();
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" type="media" href="../style.css">
    <title>New Post</title>
</head>

<body>
    <!-- 1. consulent can create new offers, select which users will see them and post them -->
    <?php // create new offers 
    $companyErr = $roleErr = $salaryErr = $locationErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // company, role, salary, location

        $company = $role = $salary = $location = "";

        // validation
        $validate = true;

        $desc = $_POST["desc"];
        $salary = floatval($_POST["salary"]);

        if (empty($_POST["company"])) {
            $nameErr = "Company name is required";
        } else {
            $name = test_input($_POST["company"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $company)) {
                $nameErr = "Only letters and white space allowed";
                $validate = false;
            } else $company = $_POST['company'];
        }
        if (empty($_POST["role"])) {
            $nameErr = "Role is required";
        } else {
            $name = test_input($_POST["role"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $role)) {
                $nameErr = "Only letters and white space allowed";
                $validate = false;
            } else $role = $_POST['role'];
        }
        if (empty($_POST["location"])) {
            $nameErr = "Location is required";
        } else {
            $name = test_input($_POST["location"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $location)) {
                $nameErr = "Only letters and white space allowed";
                $validate = false;
            } else $location = $_POST['location'];
        }

        if ($validate) {
            try {
                $pdo->query("SET FOREIGN_KEY_CHECKS=0;");
                $id = $_SESSION["userdata"]["id"];
                $sql = "INSERT INTO offers (company, role, salary, location, description, consulent)
                VALUES ('$company', '$role', '$salary', '$location', '$desc', '$id');";

                $result = $pdo->query($sql);

                if ($result) {
                    echo "Post sent.";
                } else {
                    echo "Had some problem sending post...";
                }
            } catch (Exception $e) {
                echo $e;
            }
        } else echo "Uh oh, there was an error in validation! :(";
    }

    ?>
    <div class="header container-fluid text-center pb-8">
        <h2>New Post</h2>
        <button class="btn btn-dark" onclick="window.location.href = 'consulent.php';">Back</button>
    </div>

    <div class="col lg-3 card login mx-auto">
        <div class="card-body rounded">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <label for="company">Company</label>
                <input name="company" placeholder="Company Name" maxlenght="32" required>
                <span><?php echo $companyErr; ?>* </span><br>

                <label for="role">Role Offered</label>
                <select name="role" class="custom-select-sm">
                    <?php
                    $sql = "SELECT * FROM professions;";
                    $result = $pdo->query($sql);

                    foreach ($result as $row) {
                        $row = $row[0];
                        echo "<option value=\"$row\">$row</option>";
                    }

                    ?>
                </select><br>

                <label for="location">Location</label>
                <input name="location" placeholder="Location" maxlenght="32">
                <span><?php echo $locationErr; ?>* </span><br>

                <label for="salary">Salary</label>
                <input name="salary" type="number" placeholder="Salary" min="400" max="15000" step="50" value="1000">
                <span><?php echo $salaryErr; ?>* </span><br>

                <label for="desc">Description</label>
                <textarea name="desc" placeholder="Description"></textarea><br>

                <input class="btn btn-light" type="submit" name="newpost" value="Send">
            </form>
        </div>
    </div>
</body>

</html>
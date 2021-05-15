<?php
session_start();
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
</head>

<body>
    <!-- 1. consulent can create new offers, select which users will see them and post them -->
    <?php // create new offers 
    $companyErr = $roleErr = $salaryErr = $locationErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])) {

        // company, role, salary, location

        $company = $role = $salary = $location = "";

        // validation
        $validate = true;
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

                $id = $_SESSION["userID"];

                $sql = "INSERT INTO offers (company, role, salary, location, description, consulent)
                VALUES ('$company', '$role', '$salary', '$location', '$description', '$id');";

                $result = $pdo->query($sql);

                if ($result) {
                    echo "Post sent.";
                } else {
                    echo "Had some problem sending post...";
                }
            } catch (Exception $e) {
                echo $e;
            }
        }
    }

    ?>
    <h2>New Post</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="company">Company</label>
        <input name="company" placeholder="Company Name" maxlenght="40" required>
        <span><?php echo $companyErr; ?>* </span><br>

        <label for="role">Role Offered</label>
        <input name="role" placeholder="Role" maxlenght="20">
        <span><?php echo $roleErr; ?> </span><br>

        <label for="salary">Salary</label>
        <input name="salary" type="number" placeholder="Salary">
        <span><?php echo $salaryErr; ?>* </span><br>

        <label for="desc">Description</label>
        <textarea name="desc" placeholder="Description"></textarea><br>

        <input type="submit" name="newpost" value="Send">
    </form>
    <button onclick="window.location.href = 'consulent.php';">Back</button>
</body>

</html>
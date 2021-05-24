<?php
session_start();
require_once "config.php";
if (!isset($_SESSION["userdata"])) header("Location: login.php");
$userdata = $_SESSION["userdata"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h2>Hello, <?php echo $userdata['name'] ?>!</h2>
    <p>Welcome back to your dashboard.</p>

    <div class="infos">
        <h3>You</h3>
        <p>Name: <?php echo $userdata['name'] ?></p>
        <p>Surname: <?php echo $userdata['surname'] ?></p>
        <p>Birthday: <?php echo $userdata['birthday'] ?></p>
        <p>Birthplace: <?php echo $userdata['birthplace'] ?></p>
        <p>E-mail: <?php echo $userdata['email'] ?></p>
        <?php $email = $userdata["email"]; ?>
        <?php echo "<a href=\"../uploads/$email.pdf\">Open Curriculum</a>" ?>
    </div>

    <div class="offers">
        <h3>Offers</h3>
        <?php
        // select posts for user
        $id = $userdata['id'];
        $sql = "SELECT offer FROM users_offers WHERE user ='$id'";
        $result = $pdo->query($sql)->fetchAll();

        if ($result !== array()) {
            foreach ($result as $row) {
                $row = $row["offer"];
                $offer = $pdo->query("SELECT id, role, company, location, description FROM offers WHERE id='$row'")->fetchAll(PDO::FETCH_ASSOC)[0];
                $id = $offer["id"];
                $role = $offer["role"];
                $company = $offer["company"];
                $location = $offer["location"];
                $description = $offer["description"];
                echo "$id - $role at $company in $location : $description<br>";
            }
        }
        else echo "No offers available. Try checking later.";
        ?>
    </div>


    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <br>
</body>

</html>
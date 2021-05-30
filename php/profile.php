<?php
session_start();
require_once "config.php";
if (!isset($_SESSION["userdata"])) header("Location: login.php");
if ($_SESSION['usertype'] != 0) header("Location: login.php");
$userdata = $_SESSION["userdata"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" type="media" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="p-4 pt-8">
        <div class="header container-fluid text-center pb-8">
            <h2>Hello, <?php echo $userdata['name'] ?>!</h2>
            <p>Welcome back to your dashboard.</p>
            <form method="POST" action="login.php">
                <input class="btn btn-dark" type="submit" name="logout" value="Logout">
            </form>
        </div>

        <div class="row pt-8">
            <div class="col lg-3 card infos">
                <div class="card-body rounded">
                    <h3>You</h3>
                    <p>Name: <?php echo $userdata['name'] ?></p>
                    <p>Surname: <?php echo $userdata['surname'] ?></p>
                    <p>Birthday: <?php echo $userdata['birthday'] ?></p>
                    <p>Birthplace: <?php echo $userdata['birthplace'] ?></p>
                    <p>E-mail: <?php echo $userdata['email'] ?></p>
                    <p>Profession: <?php echo $userdata['profession'] ?></p>
                    <?php $email = $userdata["email"]; ?>
                    <?php echo "<a href=\"../uploads/$email.pdf\">Open Curriculum</a>" ?>

                </div>
            </div>

            <div class="col-lg-8 offers-dashboard card">
                <h3>Offers</h3>
                <ul class="card-body list-group text-black">
                    <?php
                    // select posts for user
                    $id = $userdata['id'];
                    $sql = "SELECT offer FROM users_offers WHERE user ='$id' ORDER BY 'user'";
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
                            echo "<li class=\"list-group-item\"><b>$role at $company in $location</b><br>$description</li>";
                        }
                    } else echo "No offers available. Try checking later.";
                    ?>
                </ul>
            </div>
        </div>
        <br>
    </div>
</body>

</html>
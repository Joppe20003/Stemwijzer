<?php
session_start();
require "../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST["submit"])) {
    $naam = $_POST["username"];
    $hashed_password = hash('sha256', $password = $_POST["password"]);

    $stmt = $connection->prepare("SELECT * FROM `ste_medewerkers` WHERE `naam` = ? AND `wachtwoord` = ?");
    $stmt->bind_param("ss", $naam, $hashed_password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["admin"] == 1) {

            $_SESSION["naam"] = $naam;
            $_SESSION["admin"] = true;
            header("Location: Admin/index.php");
            exit();
        } else {
            $_SESSION["naam"] = $naam;
            $_SESSION["admin"] = false;
            header("Location: Medewerker/index.php");
            exit();
        }
    } else {
        echo "Ongeldige poepje";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Inlog.css">
    <title>Inlog</title>
</head>

<body>
    <div class="container">
        <h2>Inloggen</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="naam">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button name="submit" type="submit">Inloggen</button>
        </form>
    </div>
</body>

</html>
<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$disabled = false;
if (isset($_POST["submit"])) {
    if (!empty($_POST['nieuweWW_medewerker'])) {
        $hashed_password = hash('sha256', $_POST["nieuweWW_medewerker"]);
    } else {
        $hashed_password = $medewerker["wachtwoord"];
    }
    $insertstmt = $connection->prepare("INSERT INTO ste_medewerkers (`naam`, `achternaam`, `wachtwoord`, `email`, `admin`) VALUES (?, ?, ?, ?, ?);");
    $insertstmt->bind_param("ssssb", $_POST["naam_medewerker"], $_POST["achternaam_medewerker"], $hashed_password, $_POST["email_medewerker"], $_POST["admin_medewerker"]);

    if ($insertstmt->execute()) {
        echo "Medewerker succesvol Toegevoegd" . "<br>";
        echo $hashed_password . "<br>";
        header("Location: index.php");
        exit();
    } else {
        echo "toevoegen mislukt";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker Toevoegen</title>
    <script>
        function BackToAdmin() {
            location.replace("../admin");
        }
    </script>
</head>

<body>
    <button onclick="BackToAdmin()">Ga Terug</button>
    <form action="" method="post" class="m-0 p-o">
        <input type="text" name="naam_medewerker" value="">
        <input type="text" name="achternaam_medewerker" value="">
        <input type="text" name="nieuweWW_medewerker" value="">
        <input type="text" name="email_medewerker" value="">
        <input type="text" name="admin_medewerker" value="">
        <input type="submit" name="submit" <?php if ($disabled  == true) {echo "disabled ";} ?> class="btn btn-primary" value="Updaten">
    </form>
</body>

</html>
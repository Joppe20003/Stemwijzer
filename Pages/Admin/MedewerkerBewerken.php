<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$medewerkers = []; // Initialize the variable

$selectstmt = $connection->prepare("SELECT * FROM `ste_medewerkers` WHERE `id` =  ?");
$selectstmt->bind_param("i", $_POST["medewerker_id"]);

if ($selectstmt) {
    $selectstmt->execute();
    $result = $selectstmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $medewerker = [
                'id' => $row['id'],
                'naam' => $row['naam'],
                'achternaam' => $row['achternaam'],
                'wachtwoord' => $row['wachtwoord'],
                'email' => $row['email'],
                'admin' => $row['admin']
            ];
        }
    } else {
        echo "Geen medewerkers gevonden";
    }
} else {
    echo "Error: " . $connection->error;
}

if (isset($_POST["submit"])) {

    if (!empty($_POST['nieuweWW_medewerker'])) {
        $hashed_password = hash('sha256', $_POST["nieuweWW_medewerker"]);
    } else {
        $hashed_password = $medewerker["wachtwoord"];
    }
    $updatestmt = $connection->prepare("UPDATE `ste_medewerkers` SET `naam` = ?, `achternaam` = ?, `wachtwoord` = ?, `email` = ?, `admin` = ? WHERE `id` = ?");
    $updatestmt->bind_param("ssssii", $_POST["naam_medewerker"], $_POST["achternaam_medewerker"], $hashed_password, $_POST["email_medewerker"], $_POST["admin_medewerker"], $_POST["medewerker_id"]);

    if ($updatestmt->execute()) {
        echo "Update succesvol" . "<br>";
        echo $hashed_password . "<br>";
    } else {
        echo "Update mislukt";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker Bewerken</title>
    <script>
        function BackToAdmin() {
            location.replace("../admin");
        }
    </script>
</head>

<body>
    <button onclick="BackToAdmin()">Ga Terug</button>
    <form action="" method="post" class="m-0 p-o">
        <input type="text" name="naam_medewerker" value="<?php echo $medewerker['naam']; ?>">
        <input type="text" name="achternaam_medewerker" value="<?php echo $medewerker['achternaam']; ?>">
        <input type="text" name="nieuweWW_medewerker" value="">
        <input type="text" name="email_medewerker" value="<?php echo $medewerker['email'] ?>">
        <input type="text" name="admin_medewerker" value="<?php echo $medewerker['admin'] ?>">
        <input type="submit" name="submit" class="btn btn-primary" value="Updaten">
        <input type="hidden" name="medewerker_id" value="<?php echo $medewerker['id']; ?>">
    </form>
</body>

</html>
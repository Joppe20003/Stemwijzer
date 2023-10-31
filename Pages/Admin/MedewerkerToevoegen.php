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

include "../../Particles/header.php";

echo '<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>English E-learning</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Styles/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script rel="script" src="../../Javascript/index.js"></script>
</head>';
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
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <h3>Naam</h3>
                <input type="text" name="naam_medewerker" class="form-control" value="">
            </div>
            <div class="form-group">
                <h3>Achternaam</h3>
                <input type="text" name="achternaam_medewerker" class="form-control" value="">
            </div>
            <div class="form-group">
                <h3>Nieuw medewerker</h3>
                <input type="text" name="nieuweWW_medewerker" class="form-control" value="">
            </div>
            <div class="form-group">
                <h3>Email</h3>
                <input type="text" name="email_medewerker" class="form-control" value="">
            </div>
            <div class="form-group">
                <h3>Admin</h3>
                <input type="text" name="admin_medewerker" class="form-control" value="">
            </div>
            <button type="submit" name="submit" <?php if ($disabled == true) { echo "disabled "; } ?> class="btn btn-primary btn-block">Updaten</button>
        </form>
    </div>
    <div class="d-flex justify-content-center">
    <button onclick="BackToAdmin()" class="btn btn-secondary">Ga Terug</button>
</div>
</body>

</html>
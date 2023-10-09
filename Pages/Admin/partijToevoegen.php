<?php

require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST['submit'])) {
    $partijNaam = $_POST['partij'];
    $beschrijving = $_POST['beschrijving'];
    $sql = "INSERT INTO ste_partijen (`naam`, `beschrijving`) 
    VALUES (?, ?)";
    $stmnt = $connection->prepare($sql);
    $stmnt->bind_param("ss", $partijNaam, $beschrijving);
    $result = $stmnt->execute();

}


?>

<form method="POST">
    <label>Vul hier uw partij in:</label>
    <input type="Text" name="partij">
    <label>Vul hier uw beschrijving in:</label>
    <input type="Text" name="beschrijving">
    <input name="submit" type="submit">
</form>
<?php
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST['submit'])) {
    $stelling = $_POST['stelling'];
    $links_rechts = $_POST['links_rechts'];
    $conservatief_progressief = $_POST['conservatief_progressief'];
    $sql = "INSERT INTO ste_stellingen (`links_rechts`, `progressief_conservatief`, tekst) 
    VALUES (?, ?, ?)";
    $stmnt = $connection->prepare($sql);
    $stmnt->bind_param("iis", $links_rechts, $conservatief_progressief, $stelling);
    $result = $stmnt->execute();

}
?>

<form method="POST">
    <label>Vul hier uw stelling in:</label>
    <input type="Text" name="stelling">
    <label>Is deze stelling links of rechts:</label>
    <select name="links_rechts">
        <option value="-1">Links</option>
        <option value="1">Rechts</option>
    </select>
    <label>Is deze stelling Conservatief of Progressief:</label>
    <select name="conservatief_progressief">
        <option value="-1">Conservatief</option>
        <option value="1">Progressief</option>
    </select>   
    <input name="submit" type="submit">
</form>
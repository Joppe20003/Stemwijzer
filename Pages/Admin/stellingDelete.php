<?php
require '../../Particles/conn.php';
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$id = $_GET['id'];

$sql = "DELETE FROM `ste_stellingen` WHERE id = ?";
$stmnt = $connection->prepare($sql);
$stmnt->bind_param("i", $id);
$stmnt->execute();

$sql2 = "DELETE FROM `ste_stellingen_partijen` WHERE ste_stellingen_partijen.ste_stellingen_id = ?";
$stmnt2 = $connection->prepare($sql2);
$stmnt2->bind_param("i", $id);
$stmnt2->execute();

header('Location: index.php');
?>
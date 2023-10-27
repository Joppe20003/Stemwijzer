<?php
$dbhost = "localhost";
$user = "root";
$pass = "";
$dbname = "stemwijzer";

$connection = mysqli_connect($dbhost, $user, $pass, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$postData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($postData, true);

$partyId = $data['partyId'];
$stellingId = $data['stellingId'];
$actie = $data['actie'];

if ($actie == "toevoegen") {
    $sql = "INSERT INTO `ste_stellingen_partijen`(`ste_partij_id`, `ste_stellingen_id`, `eens`) VALUES (?,?,0)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ii", $partyId, $stellingId);
    $result = $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["Result" => "Rows insert"]);
    } else {
        echo json_encode(["Result" => "0 Rows insert"]);
    }
} else if ($actie == 'verwijderen'){
    $sql = "DELETE FROM `ste_stellingen_partijen` WHERE ste_partij_id = ? AND ste_stellingen_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ii", $partyId, $stellingId);
    $result = $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["Result" => "Row delete"]);
    } else {
        echo json_encode(["Result" => "0 Row delete"]);
    }
}
?>
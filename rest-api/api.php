<?php
require '../Particles/conn.php';

$connectionClass = new Connection();

$con = $connectionClass->setConnection();

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$sql = "SELECT * FROM ste_stellingen_partijen LEFT JOIN ste_stellingen ON ste_stellingen_partijen.ste_stellingen_id = ste_stellingen.id LEFT JOIN ste_partijen ON ste_stellingen_partijen.ste_partij_id = ste_partijen.id;";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Failed to prepare SQL query: " . $con->error);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $data3 = array(); // Initialize an empty array to store the data

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data3[] = $row;
        }
    } else {
        echo "No rows found in the result set.";
    }
} else {
    die("Error executing SQL query: " . $stmt->error);
}

$sql = "SELECT * FROM `ste_stellingen`";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Failed to prepare SQL query: " . $con->error);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $data2 = array(); // Initialize an empty array to store the data

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data2[] = $row;
        }
    } else {
        echo "No rows found in the result set.";
    }
} else {
    die("Error executing SQL query: " . $stmt->error);
}

$sql = "SELECT * FROM `ste_partijen`";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Failed to prepare SQL query: " . $con->error);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $data = array(); // Initialize an empty array to store the data

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data[] = $row;
        }
    } else {
        echo "No rows found in the result set.";
    }
} else {
    die("Error executing SQL query: " . $stmt->error);
}

// Close the database connection when you're done
$stmt->close();
$con->close();

// Create an associative array with the key "Data"
$mainArray = array("Data" => array("Partijen" => $data, "Stellingen" => array()));

// Organize the "Stellingen" array with "Eens" and "Oneens" parties
foreach ($data2 as $stelling) {
    $stellingId = $stelling['id'];

    // Initialize the "Eens" and "Oneens" arrays within the "Stelling" array
    $stelling['Eens'] = array();
    $stelling['Oneens'] = array();
    $stelling['Geen_mening'] = array();

    // Find parties that agree ("Eens") or disagree ("Oneens") with this statement
    foreach ($data3 as $combinatie) {
        if ($combinatie['ste_stellingen_id'] == $stellingId) {
            if ($combinatie['eens'] == 1) {
                // Add party ID to "Eens" array within the current "Stelling" array
                $stelling['Eens'][] = $combinatie['ste_partij_id'];
            } elseif ($combinatie['eens'] == -1) {
                // Add party ID to "Oneens" array within the current "Stelling" array
                $stelling['Oneens'][] = $combinatie['ste_partij_id'];
            } elseif ($combinatie['eens'] == 0) {
                $stelling['Geen_mening'][] = $combinatie['ste_partij_id'];
            }
        }
    }

    // Add the modified $stelling array to the "Stellingen" array
    $mainArray["Data"]["Stellingen"][] = $stelling;
}

// Encode the associative array as JSON
if (isset($_GET['partijen'])) {
    $data = array('data' => $mainArray["Data"]["Partijen"]);
    echo json_encode($data);
}

if (isset($_GET['stellingen'])) {
    $data = array('data' => $mainArray["Data"]["Stellingen"]);
    echo json_encode($data);
}
?>

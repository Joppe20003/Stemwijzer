<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$medewerkers = []; // Initialize the variable
$medewerker_id = 0;
if ($medewerker_id == 0) {
    $medewerker_id = $_POST["medewerker_id"];
} else {
}

$medewerker_id = 0;
if ($medewerker_id <= 0) {
    $medewerker_id = $medewerker_id;
}

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
                'admin' => $row['admin']
            ];
            $medewerkers[] = $medewerker;
        }
    } else {
        echo "Geen medewerkers gevonden";
    }
} else {
    echo "Error: " . $connection->error;
}

if (isset($_POST["submit"])) {
    if (!(isset($_POST["nieuweWW"]))) {
            $updatestmt = $connection->prepare("UPDATE `ste_medewerkers` SET `naam` = ?, `achternaam` = ?, `wachtwoord` = ?, `admin` = ? WHERE `id` = $medewerker_id");
            $updatestmt->bind_param("sssi", $_POST["naam"], $_POST["achternaam"], $_POST["nieuweWW"], $_POST["admin"]);
        } else {
            echo "Oude wachtwoord komt niet overeen!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker Bewerken</title>
</head>

<body>
    <div class="col-lg-6 pt-2 pb-2">
        <div class="bg-white p-2 rounded overflow-auto shadow border border-light">
            <div class="d-flex justify-content-between">
                <h6>Medewerkers</h6>
            </div>
            <section>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Naam</th>
                                <th>achternaam</th>
                                <th>Niuewe Wachtwoord</th>
                                <th>admin</th>
                                <th>Bewerken</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($medewerkers)) foreach ($medewerkers as $medewerker) : ?>
                                <tr>
                                    <th scope="row"><?php echo $medewerker['id']; ?></th>
                                    <td>
                                        <input type="text" name="naam" value="<?php echo $medewerker['naam']; ?>">
                                    </td>
                                    <td>
                                        <input type="text" name="achernaam" value="<?php echo $medewerker['achternaam']; ?>">
                                    </td>
                                    <td>
                                        <input type="text" name="nieuweWW" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="admin" value="<?php echo $medewerker["admin"] ?>">
                                    </td>
                                    <td>
                                        <form action="" method="post" class="m-0 p-o">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Updaten">
                                            <input type="hidden" name="medewerker_id" value="<?php echo $medewerker['id']; ?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
<?php
echo '<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stemwijzer</title>

    <!-- CSS resources -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Styles/styles.css">

    <!-- JavaScript resources -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="../../Javascript/index.js"></script>
    <script src="../../Javascript/stelling.js"></script>
</head>
';

include "header.php";
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$stelling_id = $_GET['id'];
$sql = "SELECT * FROM `ste_stellingen` WHERE id=". $stelling_id .";";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stelling = $row['tekst'];
        $links_rechts = $row['links_rechts'];
        $progressief_conservatief = $row['progressief_conservatief'];
    }
}

if (isset($_POST['opslaan'])) {
    $linksofrechts = $_POST['links_rechts'];
    $progressiefofconservatief = $_POST['progressief_conservatief'];
    echo $progressiefofconservatief;
    $stellingNaam = $_POST['stelling'];
    $sql = ("UPDATE `ste_stellingen` SET `links_rechts`=?, `progressief_conservatief`=?, `tekst`=? WHERE id=?");
    echo $sql;
    $stmnt = $connection->prepare($sql);
    $stmnt->bind_param("iisi", $linksofrechts, $progressiefofconservatief, $stellingNaam, $stelling_id);
    $stmnt->execute();

}

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Partij koppelen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label>Kies een partij:</label>
                <form>
                    <select class="form-select mt-1" id="selectedPartyForm">
                        <option value="VVD" data-party="1">VVD</option>
                        <option value="CDA" data-party="2">CDA</option>
                        <option value="BBB" data-party="3">BBB</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="checkDuplicates(document.getElementById('selectedPartyForm').value,document.getElementById('selectedPartyForm').options[document.getElementById('selectedPartyForm').selectedIndex].getAttribute('data-party'),<?php echo $_GET['id'] ?>,'toevoegen')">Koppelen</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="bg-light p-2 mt-2 mb-2 rounded" style="display: flex; flex-direction: column; align-items: center;">
                <h6 class="fs-3">Stelling 1:</h6>
                <input name="stellingssss" value="<?php echo $stelling;?>" class="fs-3 p w-100"></input>
            </div>
        </div>
        <div class="col-lg-12">
            <form class="mt-2 mb-2 p-2 bg-light roundend" method="POST">
                <div class="mb-3">
                    <input name="stelling" value="<?php echo $stelling;?>" class=" fs-3 p w-100"></input>
                    <label for="exampleInputEmail1" class="form-label">Deze stelling is:</label>
                    <select name="links_rechts" class="form-select" aria-label="Default select example">
                        <option selected>Selecteer een optie</option>
                        <option <?php if ($links_rechts == 1) { echo "selected"; } ?> value="1">Rechts</option>
                        <option <?php if ($links_rechts == -1) { echo "selected"; } ?> value="-1">Links</option>
                    </select> 
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">De stelling is:</label>
                    <select name="progressief_conservatief" class="form-select" aria-label="Default select example">
                        <option selected>Selecteer een optie</option>
                        <option <?php if ($progressief_conservatief == 1) { echo "selected"; } ?> value="1">Progrossief</option>
                        <option <?php if ($progressief_conservatief == -1) { echo "selected"; } ?> value="-1">Conservatief</option>
                    </select>
                </div>
                <button type="submit" name="opslaan" class="btn btn-primary w-100">Opslaan</button>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="alert alert-danger" id="formSelectError" role="alert" style="display: none; justify-content: center">Partij is al toegevoegd aan een stelling!</div>
        </div>
        <div class="col-lg-4">
            <div class="bg-light mt-2 p-2 rounded">
                <div class="d-flex" style="justify-content: space-between">
                    <h6 class="m-0">Partijen die voor de stelling zijn:</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setAction('Eens')">Toevoegen</button>
                </div>
                <div class="containerStelling" id="containerEens">
                <?php
                $sql = "SELECT *, ste_partijen.id AS 'partij_id' FROM `ste_stellingen_partijen` LEFT JOIN ste_partijen ON ste_stellingen_partijen.ste_partij_id = ste_partijen.id WHERE ste_stellingen_id=". $stelling_id ." AND eens = 1;";
                $result = mysqli_query($connection, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        foreach ($result as $row) {
                            echo '<div class="stelling_record d-flex rounded" id="stellingPartyName_' . $row['naam'] . '" style="justify-content: space-between">-' . $row['naam'] . '<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true" onclick="addPartyEens(\'' . $row['naam'] . '\',\'' . $row['partij_id'] . '\',\'' . $_GET['id'] . '\',\'verwijderen\')"></a></div></div>';
                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bg-light mt-2 p-2 rounded">
                <div class="d-flex" style="justify-content: space-between">
                    <h6 class="m-0">Partijen die  geen mening hebben over de stelling zijn:</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setAction('GeenMening')">Toevoegen</button>
                </div>
                <div class="containerStelling" id="containerGeenMening">
                <?php
                $sql = "SELECT *, ste_partijen.id AS 'partij_id' FROM `ste_stellingen_partijen` LEFT JOIN ste_partijen ON ste_stellingen_partijen.ste_partij_id = ste_partijen.id WHERE ste_stellingen_id=". $stelling_id ." AND eens = 0;";
                $result = mysqli_query($connection, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        foreach ($result as $row) {
                            echo '<div class="stelling_record d-flex rounded" id="stellingPartyName_' . $row['naam'] . '" style="justify-content: space-between">-' . $row['naam'] . '<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true" onclick="addPartyEens(\'' . $row['naam'] . '\',\'' . $row['partij_id'] . '\',\'' . $_GET['id'] . '\',\'verwijderen\')"></a></div></div>';
                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bg-light mt-2 p-2 rounded">
                <div class="d-flex" style="justify-content: space-between">
                    <h6 class="m-0">Partijen die niet voor de stelling zijn:</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setAction('Oneens')">Toevoegen</button>
                </div>
                <div class="containerStelling" id="containerOneens">
                <?php
                $sql = "SELECT *, ste_partijen.id AS 'partij_id' FROM `ste_stellingen_partijen` LEFT JOIN ste_partijen ON ste_stellingen_partijen.ste_partij_id = ste_partijen.id WHERE ste_stellingen_id=". $stelling_id ." AND eens = -1;";
                $result = mysqli_query($connection, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        foreach ($result as $row) {
                            echo '<div class="stelling_record d-flex rounded" id="stellingPartyName_' . $row['naam'] . '" style="justify-content: space-between">-' . $row['naam'] . '<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true" onclick="addPartyEens(\'' . $row['naam'] . '\',\'' . $row['partij_id'] . '\',\'' . $_GET['id'] . '\',\'verwijderen\')"></a></div></div>';
                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
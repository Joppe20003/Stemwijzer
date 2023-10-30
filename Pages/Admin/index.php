<?php
session_start();
// if($admin != true){
//     header("Location: ../Medewerker/index.php");
// }else if($ingelogged != true){
//     header("location : ../inlog.php");
// }

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

require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();


$selectstmt = $connection->prepare("SELECT * FROM `ste_medewerkers`");

if ($selectstmt) {
    $selectstmt->execute();
    $result = $selectstmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $medewerker = [
                'id' => $row['id'],
                'naam' => $row['naam'],
                'achternaam' => $row['achternaam']
            ];
            $medewerkers[] = $medewerker;
        }
    } else {
        echo "Geen medewerkers gevonden";
    }
} else {
    echo "Error: " . $connection->error;
}


?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 pt-2 pb-2">
            <div class="d-flex justify-content-between">
                <h6>Partijen</h6>
                <div>
                    <label>Staat de partij er niet bij? klik</label><a href="partijToevoegen.php" style="margin-left: 4px; margin-right: 4px">hier</a><label>om er een toe te voegen</label>
                </div>
            </div>
            <div class="row pb-2">
                <?php
                $sql = 'SELECT naam FROM `ste_partijen` WHERE 1';
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    
                ?>

                <div class="col-md-3 col-lg-2 m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px"><?php echo $row['naam'];?><i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-6 pt-2 pb-2">
            <div class="bg-white p-2 rounded overflow-auto shadow border border-light">
                <div class="d-flex justify-content-between">
                    <h6>Medewerkers</h6>
                    <a href="#" class="btn btn-primary m-1">Nieuwe medewerker aanmaken</a>
                </div>
                <section>
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naam</th>
                                    <th>E-mail</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($medewerkers)) foreach ($medewerkers as $medewerker) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $medewerker["id"] ?></th>
                                        <td><?php echo $medewerker["naam"]; ?></td>
                                        <td><?php echo $medewerker["achternaam"]; ?></td>
                                        <td>
                                            <form action="" class="m-0 p-0">
                                                <input type="submit" class="btn btn-danger" value="Verwijderen">
                                            </form>
                                            <form action="MedewerkerBewerken.php" method="post" class="m-0 p-o">
                                                <input type="hidden" name="medewerker_id" value="<?php echo $medewerker['id']; ?>">
                                                <input type="submit" class="btn btn-primary" value="Bewerken">
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
        <div class="col-lg-12 bg-light pt-2 pb-2">
            <h6>Uitleg partijen:</h6>
            <label class="mt-1 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ipsum ligula, posuere a mi non, hendrerit dignissim nunc. Sed laoreet pellentesque velit, nec porttitor arcu congue quis. Nullam lacinia neque vitae nisi eleifend, nec porttitor turpis laoreet. Proin felis lacus, convallis sed pulvinar et, lacinia vitae ligula. Praesent a diam nulla. Aliquam eleifend eros dictum, fermentum dolor a, dapibus velit. Etiam sodales lectus in nulla posuere semper. Donec ullamcorper semper odio ut ultrices. Suspendisse lobortis, nibh vitae scelerisque porttitor, mi nunc tempus libero, vitae finibus diam diam in sem.</label>
            <div class="bg-white p-2 rounded overflow-auto shadow border border-light">
                <div class="d-flex justify-content-between">
                    <h6>Stellingen:</h6>
                    <a href="stellingToevoegen.php" class="btn btn-primary m-1">Nieuwe stelling aanmaken</a>
                </div>
                <section>
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped table-hover">
                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stelling</th>
                                    <th>Partijen gekoppeld</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `ste_stellingen`;";
                                $result = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?php echo $row['tekst']; ?></td>
                                            <td></td>
                                            <td>
                                                <div class="m-0 p-0">
                                                    <a class="btn btn-danger">Verwijderen</a>
                                                    <a href="stelling.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Bewerken</a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?php
session_start();

if($ingelogged != true OR $admin != true){
    header("location : ../inlog.php");
}
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
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Stemwijzer</a>
        <button class="btn btn-outline-light me-2" type="button">Uitloggen</button>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 pt-2">
            <div class="d-flex justify-content-between">
                <h6>Partijen</h6>
                <div>
                    <label>Staat de partij er niet bij? klik</label><a href="#" style="margin-left: 4px; margin-right: 4px">hier</a><label>om er een toe te voegen</label>
                </div>
            </div>
            <div class="row row-cols-4 pb-2">
                <div class="col m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px">VVD<i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
                <div class="col m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px">D66<i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
                <div class="col m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px">Pvda<i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
                <div class="col m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px">PVV<i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
                <div class="col m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px">CDA<i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
                <div class="col m-0 p-0">
                    <div class="rounded shadow p-2 hover-background-gray" style="position: relative; margin: 5px">BBB<i class="fa fa-pencil" style="font-size: 20px; right: 27.5px; color: black; position: absolute" aria-hidden="true"></i><i href="#" class="fa fa-trash" style="font-size: 20px; right: 7.5px; color: black; position: absolute" aria-hidden="true"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 bg-light pt-2 pb-2">
            <h6>Uitleg partijen:</h6>
            <label class="mt-1 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ipsum ligula, posuere a mi non, hendrerit dignissim nunc. Sed laoreet pellentesque velit, nec porttitor arcu congue quis. Nullam lacinia neque vitae nisi eleifend, nec porttitor turpis laoreet. Proin felis lacus, convallis sed pulvinar et, lacinia vitae ligula. Praesent a diam nulla. Aliquam eleifend eros dictum, fermentum dolor a, dapibus velit. Etiam sodales lectus in nulla posuere semper. Donec ullamcorper semper odio ut ultrices. Suspendisse lobortis, nibh vitae scelerisque porttitor, mi nunc tempus libero, vitae finibus diam diam in sem.</label>
            <div class="bg-white p-2 rounded overflow-auto shadow border border-light">
                <div class="d-flex justify-content-between">
                    <h6>Hier onder ziet u tabel voor alle stellingen</h6>
                    <a href="#" class="btn btn-primary">Nieuwe stelling aanmaken</a>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nummer</th>
                        <th scope="col">Stelling</th>
                        <th scope="col">Partijen stellingen gekoppeld</th>
                        <th scope="col">Acties</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Kinderopvang moet voor alle ouders ten minste drie dagen in de week gratis worden</td>
                        <td>12</td>
                        <td>
                            <form action="#" method="post" class="m-0">
                                <input type="submit" class="btn btn-primary" value="Details">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
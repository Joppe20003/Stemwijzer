<?php
echo '<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stemwijzer</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Styles/styles.css">
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script rel="script" src="../../Javascript/index.js"></script>
</head>';
?>
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Stemwijzer</a>
        <button class="btn btn-outline-light me-2" type="button">Uitloggen</button>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="bg-light p-2 mt-2 mb-2 rounded" style="display: flex; flex-direction: column; align-items: center;">
                <h6 class="fs-3">Stelling 1:</h6>
                <span class="fs-3 p">Het openbaar vervoer in nederland moet gratis worden voor mensen.</span>
            </div>
        </div>
        <div class="col-lg-12">
            <form class="mt-2 mb-2 p-2 bg-light roundend">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Deze stelling is:</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecteer een optie</option>
                        <option value="1">Rechts</option>
                        <option value="2">Links</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">De stelling is:</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecteer een optie</option>
                        <option value="1">Progrossief</option>
                        <option value="2">Conservatief</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Opslaan</button>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="bg-light mt-2 p-2 rounded">
                <div class="d-flex" style="justify-content: space-between">
                    <h6 class="m-0">Partijen die voor de stelling zijn:</h6>
                    <button class="btn btn-primary">Toevoegen</button>
                </div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-VVD<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-FVD<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-CDA<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-D66<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg-light mt-2 p-2 rounded">
                <div class="d-flex" style="justify-content: space-between">
                    <h6 class="m-0">Partijen die tegen de stelling zijn:</h6>
                    <button class="btn btn-primary">Toevoegen</button>
                </div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-VVD<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-FVD<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-CDA<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
                <div class="stelling_record d-flex rounded" style="justify-content: space-between">-D66<div><a href="#" class="fa fa-trash-o text-danger" style="font-size: 25px; text-decoration: none" aria-hidden="true"></a></div></div>
            </div>
        </div>
    </div>
</div>
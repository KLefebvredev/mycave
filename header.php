<?php
if (empty(session_id())) {
    session_start();
};


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCave - Le site de référence du vin</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img_logo/wine32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img_logo/wine16.png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <header>

    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/img_logo/wine64.png" alt="Logo mycave symbolisant deux verres et une bouteilles de vin rouge"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="add.php">Ajouter une bouteille</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
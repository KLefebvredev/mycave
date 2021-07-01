<?php

session_start();
require __DIR__ . '/header.php';
if (isset($_POST['id']) && isset($_FILES)) {
    //connexion à la base de donnée
    require 'connect.php';

    mb_internal_encoding("UTF-8");
    function mb_ucfirst($string)
    {
        $string = mb_strtolower($string);
        return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }
    var_dump($_POST);
    $id = intval($_POST['id']);
    $nom = htmlentities(mb_strtoupper(trim($_POST['nom'])), ENT_QUOTES);
    $pays = htmlentities(mb_strtoupper(trim($_POST['pays'])), ENT_QUOTES);
    $region = htmlentities(mb_strtoupper(trim($_POST['region'])), ENT_QUOTES);
    $cepage = htmlentities(trim($_POST['cepage']), ENT_QUOTES);
    $annee = intval($_POST['annee']);
    $description = htmlentities(mb_strtoupper(trim($_POST['description'])), ENT_QUOTES);
    $_FILES['image']['name'];
    $_FILES['image']['type'];
    $_FILES['image']['size'];
    $_FILES['image']['tmp_name'];
    $_FILES['image']['error'];
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['image']['name'], '.');
    if (($_FILES['image']['size'] > 0) && ($_FILES['image']['size'] < 1000000) && (in_array($extension, $extensions))) {
        $image = uniqid() . '.' . $_FILES['image']['name'];
        $image = strtr(
            $image,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
        );
        $image = preg_replace('/([^.a-z0-9]+)/i', '-', $image);
        $image = explode('.', $image);
        $nom_image = $image['1'];
        $image = $image['1'] . '.' . $image['2'];
        $resultat = move_uploaded_file($_FILES['image']['tmp_name'], './assets/img/' . $image);
    } else {
        $resultat = FALSE;
    }
    $sql_file = $resultat ? ', image=:image' : '';
    $sql = "UPDATE mille 
        SET annee=:annee, description=:description, nom=:nom, pays=:pays, region=:region, cepage=:cepage$sql_file
        WHERE id=:id";

    if ($req = $db->prepare($sql)) {
        $req->bindParam(":nom", $nom, PDO::PARAM_STR);
        $req->bindParam(":annee", $annee, PDO::PARAM_INT);
        $req->bindParam(":pays", $pays, PDO::PARAM_STR);
        $req->bindParam(":region", $region, PDO::PARAM_STR);
        $req->bindParam(":cepage", $cepage, PDO::PARAM_STR);
        $req->bindParam(":description", $description, PDO::PARAM_STR);
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        if ($sql_file) {
            $req->bindParam(":image", $image, PDO::PARAM_STR);
        }

        if ($req->execute()) {
            $_SESSION['message'] = "Bouteille modifié !";
            header('Location: index.php');
        } else {
            $_SESSION['erreur'] = "Un problème est survenu !";
            header('Location: index.php');
        }
    }
} else {
    $_SESSION['erreur'] = "Un problème est survenu !";
    header('Location: index.php');
}

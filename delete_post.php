<?php
//On démarre une session
session_start();

require_once('bottles.php');




// Est-ce que l'id existe et n'est pas vide dans l'url
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');


    //On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = '
    SELECT * 
    FROM mille m
    WHERE m.id = :id
    ';
    $query = $db->prepare($sql);

    //on accroche les paramètre (id)

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    //on execute la requète 
    $query->execute();

    //on récupère le produit
    $produit = $query->fetch();

    // on vérifie si le produit existe
    if (!$produit) {
        $_SESSION['erreur'] = "Ce produit n'existe pas !!!";
        header('Location: index.php');
        die();
    }
    $sql = 'DELETE FROM `mille` WHERE `id` = :id;';

    //On prépare la requète
    $query = $db->prepare($sql);

    //on accroche les paramètre (id)

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    //on execute la requète 
    $query->execute();
    $_SESSION['message'] = "Bouteille supprimée !!!";
    header('Location: index.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

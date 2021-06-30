<?php
if (empty(session_id())) {
    session_start();
}
try {
    //Connection à la base
    $db = new PDO('mysql:host=localhost;dbname=mycavev2;port=3307;cherset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}

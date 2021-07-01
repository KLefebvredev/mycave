<?php

session_start();
require __DIR__ . '/header.php';

include 'connect.php';

mb_internal_encoding("UTF-8");
function mb_ucfirst($string)
{
	$string = mb_strtolower($string);
	return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
}


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
$couleur = intval($_POST['couleur']);
$array_post = array($nom, $pays, $region, $cepage, $annee, $description, $couleur);
$array_post_string = array($nom, $pays, $region, $cepage, $couleur);

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
	$image = 'generic.jpg';
}

if (in_array('', $array_post)) {
	$_SESSION['erreur'] = "Merci de renseigner les champs manquants !";
} elseif (strlen($_POST['description'])  < 4) {
	$_SESSION['erreur'] = "La description de la bouteille doit faire plus de 4 caractères";
} elseif (strlen($_POST['description'])  > 512) {
	$_SESSION['erreur'] = "La description de la bouteille doit faire moins de 512 caractères";
} elseif (strlen($_POST['annee'])  < 4) {
	$_SESSION['erreur'] = "le vin de cette année n'est pas encore récolté";
} else {
	$req = $db->prepare('
					INSERT INTO mille(annee, description,image,couleur_id, nom, pays, region, cepage)
					VALUES (:annee, :description, :image, :couleur_id, :nom, :pays, :region, :cepage);
				');
	$req->execute(array(
		'annee' => $_POST['annee'],
		'description' => $_POST['description'],
		'image' => $image,
		'couleur_id' => $_POST['couleur'],
		'nom' => $_POST['nom'],
		'pays' => $_POST['pays'],
		'region' => $_POST['region'],
		'cepage' => $_POST['cepage']
	));
	$_SESSION['message'] = "Bouteille ajoutée !";
}
header('Location: index.php');

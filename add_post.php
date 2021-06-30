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

$nom = htmlentities(mb_ucfirst(trim($_POST['nom'])), ENT_QUOTES);
$pays = htmlentities(mb_strtoupper(trim($_POST['pays'])), ENT_QUOTES);
$region = htmlentities(mb_strtoupper(trim($_POST['region'])), ENT_QUOTES);
$cepage = htmlentities(trim($_POST['cepage']), ENT_QUOTES);
$annee = htmlentities(trim($_POST['annee']), ENT_QUOTES);
$description = htmlentities(mb_strtoupper(trim($_POST['description'])), ENT_QUOTES);
$_FILES['image']['name'];
$_FILES['image']['type'];
$_FILES['image']['size'];
$_FILES['image']['tmp_name'];
$_FILES['image']['error'];
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['image']['name'], '.');
$couleur = intval($_POST['couleur']);
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
$msg = 'Référence Ajoutée!';

echo '<div class="alert alert-success mt-4 text-center m-auto w-25" role="alert">
' . $msg;

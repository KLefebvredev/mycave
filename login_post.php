<?php
require 'connect.php';
$login = $_POST['login'];
$password = $_POST['password'];
if (in_array('', $_POST)) {
	$msg_error = '';
	if (empty($login)) {
		$msg_error .= 'Merci de renseigner votre login<br>';
	}
	if (empty($password)) {
		$msg_error .= 'Merci de renseigner votre mot de passe<br>';
	}
} else {
	$login = htmlentities(trim(mb_strtolower($login)), ENT_QUOTES); // faille XSS
	$password = htmlentities(trim($password), ENT_QUOTES);

	$req = $db->prepare("
		SELECT *
		FROM user u
		INNER JOIN role r
		ON u.role_id = r.id
		WHERE u.email = :email
	");
	$req->bindValue(':email', $login, PDO::PARAM_STR);

	$req->execute();
	$result = $req->fetchObject();
	if (!$result) {
		$msg_error = 'Votre login ou mot de passe est inconnu';
	} else {

		if (password_verify($password, $result->password)) {
			$msg_success = 'Vous êtes connecté';
		} else {
			$msg_error = 'Votre login ou mot de passe est inconnu';
		}
	}
}

$msg = isset($msg_error);

$last_url = $_SERVER['HTTP_REFERER']; // url d'où je viens
if (strpos($last_url, '?') !== FALSE) {
	$req_get = strrchr($last_url, '?');
	$last_url = str_replace($req_get, '', $last_url);
}
if ($msg) {
	header("Location: $last_url?msg=$msg_error");
} else {
	$_SESSION['prenom'] 	= $result->prenom;
	$_SESSION['nom'] 	= $result->nom;
	$_SESSION['id'] 		= $result->id;
	$_SESSION['role'] 	= $result->role_name;

	header("Location: $last_url?msg=$msg_success");
}

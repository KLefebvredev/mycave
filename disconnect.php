<?php 
if(empty(session_id())) {
	session_start();
};

unset($_SESSION);
session_destroy();

$last_url = $_SERVER['HTTP_REFERER']; // url d'où je viens
if(strpos($last_url, '?') !== FALSE) {
	$req_get = strrchr($last_url, '?');
	$last_url = str_replace($req_get, '', $last_url);
}
header("Location: $last_url");
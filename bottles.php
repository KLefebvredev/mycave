<?php

require_once('connect.php');

$query = $db->prepare("
    SELECT * 
    FROM mille
");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

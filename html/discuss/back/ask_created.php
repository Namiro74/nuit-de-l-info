<?php

session_start();

require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();

if(empty($_SESSION['logged']) || !$_SESSION['logged'] || empty($_SESSION['id'])) {
	echo "You must be logged for posting question";
	exit;
}

if(empty($_POST['title']) || empty($_POST['text'])) {
	echo "Error: incomplete fields";
	exit;
}

$title=$_POST['title'];
$text=$_POST['text'];

$reqInsert=Bdd::$bdd->prepare("INSERT INTO asks (id_user, title, text) VALUES (:id_user, :title, :text)");
$reqInsert->execute(array(
	':id_user' => $_SESSION['id'],
    ':title' => $title,
    ':text' => $text));

header("Location: /discuss/?statut=postCree");
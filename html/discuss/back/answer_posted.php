<?php
session_start();
require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();

if(empty($_SESSION['logged']) || !$_SESSION['logged'] || empty($_SESSION['id'])) {
	echo "You must be logged for posting question";
	exit;
}

if(empty($_GET['id'])) {
	echo "Error: no id specified";
	exit;
}

$id=$_GET['id'];

if(empty($_POST['text'])) {
	echo "Error: no response specified";
	exit;
}

$text=$_POST['text'];

$reqInsert=Bdd::$bdd->prepare("INSERT INTO answers (id_ask, id_user, text) VALUES (:id_ask, :id_user, :text)");
$reqInsert->execute(array(
	':id_ask' => $id,
	':id_user' => $_SESSION['id'],
    ':text' => $text));

header("Location: /discuss/view_ask.php?id=".$id);
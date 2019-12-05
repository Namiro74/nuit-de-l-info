<?php

session_start();
if(empty($_SESSION['logged']) || !$_SESSION['logged'] || empty($_SESSION['id'])) {
	echo "You must be logged for posting question";
	exit;
}

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ndi;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(empty($_POST['title']) || empty($_POST['text'])) {
	echo "Error: incomplete fields";
	exit;
}

$title=$_POST['title'];
$text=$_POST['text'];

$reqInsert=$bdd->prepare("INSERT INTO asks (id_user, title, text) VALUES (:id_user, :title, :text)");
$reqInsert->execute(array(
	':id_user' => $_SESSION['id'],
    ':title' => $title,
    ':text' => $text));

echo "Ok post created";
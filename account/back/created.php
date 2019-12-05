<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ndi;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(empty($_POST['pseudo']) || empty($_POST['pass']) || empty($_POST['email'])) {
	echo "Incomplete fields";
	exit;
}

$pseudo=$_POST['pseudo'];
$pass_hash=password_hash($_POST['pass'], PASSWORD_DEFAULT);
$email=$_POST['email'];

$reqCheck=$bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
$reqCheck->execute(array(':pseudo' => $pseudo));

if($reqCheck->fetch()!=false) {
	echo "User already exists";
	exit;
}

$reqInsert=$bdd->prepare("INSERT INTO users (pseudo, email, pass) VALUES (:pseudo, :email, :pass)");
$reqInsert->execute(array(
	':pseudo' => $pseudo,
    ':pass' => $pass_hash,
    ':email' => $email));

echo "Account created";
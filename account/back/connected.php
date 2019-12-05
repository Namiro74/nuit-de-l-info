<?php

session_start();
$_SESSION['logged']=false;

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ndi;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(empty($_POST['pseudo']) || empty($_POST['pass'])) {
	echo "Incomplete fields";
	exit;
}

$pseudo=$_POST['pseudo'];
$pass=$_POST['pass'];

$reqSearch=$bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
$reqSearch->execute(array(':pseudo' => $pseudo));
$resultSearch=$reqSearch->fetch();

if($resultSearch==false) {
	echo "User doesn't exist";
	exit;
}
if(!password_verify($pass, $resultSearch["pass"])) {
	echo "Invalid password";
	exit;
}

$_SESSION['logged']=true;
$_SESSION['email']=$resultSearch["email"];
$_SESSION['id']=$resultSearch["id"];
$_SESSION['pseudo']=$pseudo;

echo "You're logged !!";

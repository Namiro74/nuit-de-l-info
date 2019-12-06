<?php

session_start();
$_SESSION['logged']=false;

require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();

if(empty($_POST['pseudo']) || empty($_POST['pass'])) {
	header("Location: /account/connect.php?error=fields");
	exit;
}

$pseudo=$_POST['pseudo'];
$pass=$_POST['pass'];

$reqSearch=Bdd::$bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
$reqSearch->execute(array(':pseudo' => $pseudo));
$resultSearch=$reqSearch->fetch();

if($resultSearch==false) {
	header("Location: /account/connect.php?error=userexists");
	exit;
}
if(!password_verify($pass, $resultSearch["pass"])) {
	header("Location: /account/connect.php?error=badpassword");
	exit;
}

$_SESSION['logged']=true;
$_SESSION['email']=$resultSearch["email"];
$_SESSION['id']=$resultSearch["id"];
$_SESSION['pseudo']=$pseudo;

header("Location: /");
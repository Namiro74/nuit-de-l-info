<?php

session_start();

require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();

if(empty($_POST['pseudo']) || empty($_POST['pass']) || empty($_POST['email']) || empty($_POST['recaptcha_response'])) {
	header("Location: /account/create.php?error=fields");
	exit;
}

$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret = '6LePXcYUAAAAALPAcJayIZKtDsW9Ok7XT6ulLp-e';
$recaptcha_response = $_POST['recaptcha_response'];
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
$recaptcha = json_decode($recaptcha);
if ($recaptcha->score < 0.5) {
	header("Location: /account/create.php?error=recaptcha");
	exit;
}

$pseudo=$_POST['pseudo'];
$pass_hash=password_hash($_POST['pass'], PASSWORD_DEFAULT);
$email=$_POST['email'];

$reqCheck=Bdd::$bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
$reqCheck->execute(array(':pseudo' => $pseudo));

if($reqCheck->fetch()!=false) {
	header("Location: /account/create.php?error=usersexists");
	exit;
}

$reqInsert=Bdd::$bdd->prepare("INSERT INTO users (pseudo, email, pass) VALUES (:pseudo, :email, :pass)");
$reqInsert->execute(array(
	':pseudo' => $pseudo,
    ':pass' => $pass_hash,
    ':email' => $email));

$reqSearch=Bdd::$bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
$reqSearch->execute(array(':pseudo' => $pseudo));
$resultSearch=$reqSearch->fetch();

if($resultSearch==false) {
	header("Location: /account/create.php?error=bdderror");
	exit;
}

$_SESSION['logged']=true;
$_SESSION['email']=$email;
$_SESSION['id']=$resultSearch["id"];
$_SESSION['pseudo']=$pseudo;

header("Location: /");
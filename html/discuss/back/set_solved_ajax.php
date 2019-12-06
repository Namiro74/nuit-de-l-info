<?php
session_start();
require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();

if(empty($_GET['id']) || empty($_GET['status'])) {
	echo "Error: argument missing";
	exit;
}

$id=$_GET['id'];
$status="0";
if($_GET['status']=="true") {
	$status="1";
}

$reqAsk=Bdd::$bdd->prepare("SELECT * FROM asks WHERE id = :id");
$reqAsk->execute(array(":id" => $id));
if(($resultAsk=$reqAsk->fetch()) == false) {
	echo "Error: post specified doesn't exist";
	exit;
}

if(empty($_SESSION['logged']) || !$_SESSION['logged'] || empty($_SESSION['id']) || ($_SESSION['id']!=$resultAsk["id_user"])) {
	echo "Error: you're not allowed to change the status";
	exit;
}

$reqUpdateStatus=Bdd::$bdd->prepare("UPDATE asks SET solved = :solved WHERE id = :id");
$reqUpdateStatus->execute(array(
	":solved" => $status,
	":id" => $id));

echo "Done";
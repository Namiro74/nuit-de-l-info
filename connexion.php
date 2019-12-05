<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="style.css" rel="stylesheet">
		<title>PLOUF, à l'aide !!</title> 
	</head>
	<?php
		require_once("header.php");
	?>
	<body>
		<form method="post" action="account/back/connected.php">
			<br/>
			Nom d'utilisateur/adresse email :&nbsp;&nbsp;<input type="text" size="35" name="pseudo"/><br/><br/>
			Mot de passe :&nbsp;&nbsp;<input type="password" size="35" name="pass"/><br/><br/>
			<input type="submit"/>
		</form>
	</body>
</html>
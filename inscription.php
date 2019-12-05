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
		<form method="post" action="account/back/created.php">
			<br/>
			Nom d'utilisateur :&nbsp;&nbsp;<input type="text" name="pseudo"/><br/><br/>
			Adresse e-mail :&nbsp;&nbsp;<input type="email" name="email"/><br/><br/>
			Mot de passe :&nbsp;&nbsp;<input type="password" name="pass"/><br/><br/>
			Confirmez le mot de passe :&nbsp;&nbsp;<input type="password" name="passConfirmed"/><br/><br/>
			<input type="submit"/>
		</form>
	</body>
</html>
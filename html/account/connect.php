<?php
	session_start();
	if($_SESSION["logged"])
	{
		header("Location: /");
	}
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="/style.css" rel="stylesheet">
		<link rel="icon" href="/images/logo.jpeg" />
		<title>Connexion</title>
	</head>
	<?php
		require_once("/var/www/include/header.inc.php");
	?>
	<body>
		<div class="menuandbody">
			<?php require_once("/var/www/include/nav.inc.php"); ?>
			<div class="corps">
				<form method="post" action="/account/back/connected.php">
					<?php
						if(!empty($_GET["error"]) && $_GET["error"]=="fields")
						{
					?>
					<p>\!/ Vous avez mal rempli un ou plusieurs champs ! \!/</p>
					<?php
						}
						else if(!empty($_GET["error"]) && $_GET["error"]=="userexists")
						{
					?>
					<p>\!/ Il n'y a pas d'utilisateur à ce nom ! \!/</p>
					<?php
						}
						else if(!empty($_GET["error"]) && $_GET["error"]=="badpassword")
						{
					?>
					<p>\!/ Mauvais mot de passe ! \!/</p>
					<?php
						}
					?>
					<br/>
					Nom d'utilisateur/adresse email :&nbsp;&nbsp;<input type="text" size="35" name="pseudo"/><br/><br/>
					Mot de passe :&nbsp;&nbsp;<input type="password" size="35" name="pass"/><br/><br/>
					<input type="submit"/>
				</form>
			</div>
		</div>
	</body>
</html>
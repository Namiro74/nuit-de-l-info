<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="/style.css" rel="stylesheet">
		<link rel="icon" href="/images/logo.jpeg" />
		<title>Inscription</title> 
	</head>
	<?php
		require_once("/var/www/include/header.inc.php");
	?>
	<body>
		<div class="menuandbody">
			<?php require_once("/var/www/include/nav.inc.php"); ?>
			<div class="corps">
				<form method="post" action="/account/back/created.php">
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
					<p>\!/ Ce nom d'utilisateur existe déjà ! \!/</p>
					<?php
						}
						else if(!empty($_GET["error"]) && $_GET["error"]=="bdderror")
						{
					?>
					<p>\!/ Une erreur est survenue, veuillez réessayer ! \!/</p>
					<?php
						}
					?>
					<br/>
					Nom d'utilisateur :&nbsp;&nbsp;<input type="text" name="pseudo"/><br/><br/>
					Adresse e-mail :&nbsp;&nbsp;<input type="email" name="email"/><br/><br/>
					Mot de passe :&nbsp;&nbsp;<input type="password" name="pass"/><br/><br/>
					Confirmez le mot de passe :&nbsp;&nbsp;<input type="password" name="passConfirmed"/><br/><br/>
					<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
					<input type="submit"/>
				</form>
			</div>
		</div>
	</body>
	<script src="https://www.google.com/recaptcha/api.js?render=6LePXcYUAAAAAKUyW9D3cja-ZB1bQIow-H2MZdXo"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6LePXcYUAAAAAKUyW9D3cja-ZB1bQIow-H2MZdXo', { action: 'signup' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
</html>
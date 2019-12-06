<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="/style.css" rel="stylesheet">
		<title>PLOUF, à l'aide !!</title> 
	</head>
	<?php
		require_once("/var/www/include/header.inc.php");
	?>
	<body>
		<div class="description">
			<p>Étudiant(e) en difficulté ou à la recherche d'une info ? Pas de panique ! Ici, vous pouvez obtenir facilement des informations pratiques sur plusieurs thèmes, par exemple les aides au logement ou pour votre budget. Vous pouvez également poser une question à d'autres étudiants plus expérimentés que vous qui sauront vous aiguiller mieux que personne !</p>
		</div>
		<div class="menuandbody">
			<?php require_once("/var/www/include/nav.inc.php") ?>
			<div class="corps">
				<p class="txtcorps">Infos pratiques par thèmes</p>
				<div class="liens">
					<div class="imgtxt"><a href=""><img src="/images/Mobilité.png" /></a><p><a href="">Mobilité</a></p></div>
					<div class="imgtxt"><a href=""><img src="/images/habitat.jpg" /></a><p><a href="">Logement</a></p></div>
					<div class="imgtxt"><a href=""><img src="/images/vivre-avec-petit-budget.jpg" /></a><p><a href="">Petit budget</a></p></div>
					<div class="imgtxt"><a href=""><img src="/images/sorties.JPG" /></a><p><a href="">Sorties</a></p></div>
					<div class="imgtxt"><a href=""><img src="/images/ecologie.jpeg" /></a><p><a href="">Ecologie</a></p></div>
				</div>
				<p class="txtcorps"><a href="/discuss/" class="questioncorps">Discussion</a></p>
			</div>
		</div>
	</body>
</html>

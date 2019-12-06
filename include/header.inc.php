<header>
	<div class="titre"><h1><a href="/index.php">Plouf, à l'aide !</a></h1></div>
	<div class="conteneur">
		<?php
			if(!empty($_SESSION["logged"]) && $_SESSION["logged"])
			{
		?>

		<div class="element"><h1>Bonjour, <?php echo(htmlentities($_SESSION["pseudo"])); ?> !</h1></div>
		<div class="element"><a class="bouton" href="/account/back/disconnect.php"><h1>Déconnexion</h1></a></div>
		<?php
			}
			else
			{
		?>
		<div class="element"><a class="bouton" href="/account/connect.php"><h1>Connexion</h1></a></div>
		<div class="element"><a class="bouton" href="/account/create.php"><h1>Inscription</h1></a></div>
		<?php
			}
		?>
	</div>
</header>
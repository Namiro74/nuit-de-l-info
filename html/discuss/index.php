<?php

error_reporting(E_ALL);

session_start();
require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();

?>

<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Liste des questions</title> 
	</head>
	<body>
		<?php if(!empty($_SESSION['logged']) && $_SESSION['logged']) { ?>
		<h1>Posez votre question</h1>
			<form action="back/ask_created.php" method="post">
				<p>
					<input type="text" name="title" /><label for="title">TITRE</label>
				</p>
				<p>
					<textarea placeholder="Votre question" name="text" rows="15" cols="50"></textarea>
				</p>
				<p>
					<input type="submit" value="Posez votre question">
				</p>
			</form>
		<?php } ?>
		<h1>Liste des questions</h1>
		<section>
			<?php
				$reqListAsks=Bdd::$bdd->prepare("SELECT * FROM asks ORDER BY date DESC");
				$reqListAsks->execute();

				while($resultListAsks=$reqListAsks->fetch()) {
					$textSolved="";
					if($resultListAsks["solved"]=="1") {
						$textSolved="[R&Eacute;SOLU] ";
					}
					echo "<p>".$textSolved."<a href=\"view_ask.php?id=".$resultListAsks["id"] ."\">" . htmlentities($resultListAsks["title"]) . "</a> (".Utils::getUserName($resultListAsks["id_user"]).") ".$resultListAsks["date"]."<br /></p>";
				}
			?>
		</section>
	</body>
</html>
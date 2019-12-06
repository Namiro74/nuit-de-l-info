<?php
session_start();
require_once("/var/www/include/bdd.inc.php");
require_once("/var/www/include/utils.inc.php");

Bdd::dbConnect();
if(empty($_GET['id'])) {
	echo "No id specified";
	exit;
}
$id=$_GET['id'];
$reqAsk=Bdd::$bdd->prepare("SELECT * FROM asks WHERE id = :id");
$reqAsk->execute(array(":id" => $id));
if(($resultAsk=$reqAsk->fetch()) == false) {
	echo "Error: post specified doesn't exist";
	exit;
}
$title=htmlentities($resultAsk["title"]);
$text=htmlentities($resultAsk["text"]);

$isOwner=false;

if(!empty($_SESSION['logged']) && $_SESSION['logged'] && !empty($_SESSION['id']) && ($_SESSION['id']==$resultAsk["id_user"])) {
	$isOwner=true;
}

$reqAnswers=Bdd::$bdd->prepare("SELECT * FROM answers WHERE id_ask = :id ORDER BY date ASC");
$reqAnswers->execute(array(":id" => $id));
//var_dump($reqAnswers->fetch());

?>

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
			<div class="corpsquestion">
				<h1><?php echo $title; ?></h1>
				<section>
					<p>
						<?php echo $text; ?>
					</p>
					<?php if($isOwner) { ?>
						<input type="checkbox" name="solved" id="solved" <?php if($resultAsk["solved"]){echo "checked";}?> onclick="changeSolvedState(this);" /><label for="solved">R&Eacute;SOLU</label>
					<?php } ?>
				</section>
				<section>
					<?php
						while($resultAnswer=$reqAnswers->fetch()) {
							echo "<h3>".Utils::getUserName($resultAnswer["id_user"])."</h3>";
							echo "<i>".$resultAnswer["date"]."</i><br />";
							echo htmlentities($resultAnswer["text"]);
						}
					?>
				</section>
				<section>
					<?php if(!empty($_SESSION['logged']) && $_SESSION['logged']) { ?>
						<form action="back/answer_posted.php?id=<?php echo $id; ?>" method="post">
							<p>
								<textarea placeholder="Votre r&eacute;ponse..." name="text" rows="15" cols="50"></textarea>
							</p>
							<p>
								<input type="submit" value="R&eacute;pondre" />
							</p>
						</form>
					<?php } ?>
				</section>
			</div>
		</div>
	</body>
	<script>
		function changeSolvedState(checkbox) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "back/set_solved_ajax.php?id=<?php echo $id; ?>&status=" + checkbox.checked, true);
			xmlhttp.send();
		}
	</script>
</html>
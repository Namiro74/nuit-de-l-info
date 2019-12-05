<?php
session_start();
if(empty($_SESSION['logged']) || !$_SESSION['logged']) {
	echo "You must be logged for posting question";
	exit;
}
?>

<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Posez votre question</title> 
	</head>
	<body>
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
	</body>
</html>
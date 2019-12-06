<?php

class Utils
{
	static public function getUserName($id) {
		$reqUser=Bdd::$bdd->prepare("SELECT * FROM users WHERE id = :id");
		$reqUser->execute(array(':id' => $id));
		while($resultUser=$reqUser->fetch()) {
			return htmlentities($resultUser["pseudo"]);
		}
		return "Anonyme...";
	}
}
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

	static public function getUserIpAddr(){
    	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        	$ip = $_SERVER['HTTP_CLIENT_IP'];
    	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}else{
        	$ip = $_SERVER['REMOTE_ADDR'];
    	}
    	return $ip;
	}
}
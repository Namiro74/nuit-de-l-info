<?php

class Bdd
{
	static public $bdd;
    static public function dbConnect()
    {
        try
		{
			self::$bdd = new PDO('mysql:host=localhost;dbname=ndi;charset=utf8', 'root', 'plouf');
		}
		catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}
    }
}
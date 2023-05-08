<?php 
	// connection a la db

	define('HOST', 'localhost');
	define('DB_NAME', 'appart');
	define('USER', 'root');
	define('PASS', '');
	try {
		$db = new PDO('mysql:host='.HOST. ';dbname='. DB_NAME, USER, PASS);
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e;
	}

 ?>
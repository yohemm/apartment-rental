<?php 
	define('HOST', 'mysql-yohem.alwaysdata.net');
	define('DB_NAME', 'yohem_papa');
	define('USER', 'yohem');
	define('PASS', 'Vaxeyohe88');
	try {
		$db = new PDO('mysql:host='.HOST. ';dbname='. DB_NAME, USER, PASS);
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e;
	}

 ?>
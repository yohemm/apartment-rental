<?php 

if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
	// connection a la db

define('SQLBASE', 'pgsql');
define('HOST', '83.196.52.184');
define('DB_NAME', 'appart');
define('USER', 'postgres');
define('PASS', '123456789');

try {
	$db = new PDO(SQLBASE.':host='.HOST. ';port=5432;dbname='. DB_NAME, USER, PASS);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die($e->getMessage());
}

function updateSingle(string $table, string $keyLine, string $nameColumToUpdate, string $nameInput, string $columKey='name', string $oldValue="", bool $isNull=false):bool{
	global $db;
	if($oldValue == $_POST[$nameInput]);
	$q = $db->prepare("UPDATE $table SET $nameColumToUpdate = :change WHERE $columKey='$keyLine'");
	$res = $q->execute(['change' => $_POST[$nameInput]]);
	return $res;
}
function allVisible():array{
	global $db;
	return $db->query("SELECT * FROM all_visble_location();--")->fetchAll();
}
function getAlert($id):stdClass|bool {
	global $db;
	$query = $db->prepare("SELECT * FROM alert WHERE id = :id ;--");
	$query->execute([
		'id' =>  $id
	]);
	return $query->fetchObject();
}
function allAlert():array{
	global $db;
	return $db->query("SELECT * FROM alert;--")->fetchAll();
}
function insAlert(string $content):bool{
	global $db;
	$query = $db->prepare("INSERT INTO alert(content) VALUES(:content) ;--");
	return $query->execute([
		'content' =>  $content
	]);
}
function delAlert($id):bool{
	global $db;
	$query = $db->prepare("DELETE FROM alert WHERE id = :id ;--");
	return $query->execute([
		'id' =>  $id
	]);
}
function allPages():array{
	global $db;
	return $db->query("SELECT * FROM page ;--")->fetchAll();
}
function getPage(string $name):stdClass{
	global $db;
	$query = $db->prepare("SELECT * FROM page WHERE name = :name ;--");
	$query->execute([
		'name' =>  $name
	]);
	return $query->fetchObject();
}
function getVisible(string $name):stdClass{
	global $db;
	$query = $db->prepare("SELECT * FROM all_visble_location() WHERE name = :name ;--");
	$query->execute([
		'name' =>  $name
	]);
	return $query->fetchObject();
}
function getLocation(string $id):stdClass{
	global $db;
	$query = $db->prepare("SELECT * FROM house WHERE id = :id ;--");
	$query->execute([
		'id' =>  $id
	]);
	return $query->fetchObject();
}
function allLocation():array{
	global $db;
	return $db->query('SELECT * FROM house')->fetchALL();
}

function verifyDateDispo(int $id, $startingDate, $endingDate):bool{
	global $db;
	echo 'type date';
	var_dump($endingDate);
	$query = $db->prepare("SELECT * FROM house_is_not_revserved(:house, :startDate, :endDate);--");
	$query->execute([
		'house' => $id,
		'startDate' => $startingDate,
		'endDate' => $endingDate,
	]);
	return $query->fetchColumn();
}


	

 ?>
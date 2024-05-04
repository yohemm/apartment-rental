<?php include 'database.php';
if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
	global $db;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php include '../includes/header.php'; ?>
	<title>Vosges dans le vent | Message recus</title>
</head>
<body>
	<?php 
		$req = $db->query("SELECT * FROM contatcs");
		$messages = $req -> fetchALL();
		foreach ($messages as $message) {
			echo "
				<div  class='message'>
					<h3>".$message["motif"]."</h3>
					<p>".$message["content"]."</p>
					<p class='detaille'>par : ".$message["name"].", email : ".$message["email"].", tél : ".$message["phone"].", date : ".$message["date"]."</p>
				</div>";

		}
	?>
</body>
</html>
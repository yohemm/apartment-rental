<?php include 'database.php';
if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
global $db; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include '../includes/header.php' ?>
	<title>Vosges dans le vent | Admin</title>
</head>
<body>
	<?php 
		if (isset($_GET['id'])) { // si les donner on ete envoyer

			// recuper la donner en fonction de l'id
			$req = $db -> query("SELECT * FROM contatcs WHERE id = ".$_GET['id']);
			$contact = $req ->fetchObject();?>

			<!-- afficher les dinner -->
			<div class="contactTitle">
				<h3><?= $contact->motif ?></h3>
				<p class="contactContent"><?= $contact->content;?>
				</p>
				<p>tél : <?= $contact->phone?> <br>email : <?= $contact->email ?></p>
				<p>par <?= $contact->name?>, à <?= $contact->date?></p>
		<?php }else{
			include 'contactview.php';
		} ?>
				
			</div>
</body>
</html>
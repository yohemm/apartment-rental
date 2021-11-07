<?php include 'console/database.php';
global $db; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include'includes/header.php' ?>
	<script type="text/javascript"> 
		setInterval(Change_title, 100);
		text = 'Vosges dans le vent | CONTACTS ';
	</script>
</head>
<body>
	<?php include "includes/menu-nav.php" ?>
	<div id="content">
		<form method="post" style="text-align: center;" id="contact_form">
			<h3>Votre nom :</h3><input type="text" name="nom" placeholder="Votre nom"><br>
			<h3>Votre email :</h3><input type="text" name="email" placeholder="Votre adresse email"><br>
			<h3>Votre numérot de téléphone :</h3><input type="text" name="tel" placeholder="Votre numéro de téléphone"><br>
			<h3>Votre sujet de conversation :</h3><input type="text" name="sujet" placeholder="Sujet"><br>
			<h3>Votre message :</h3><textarea name="content" placeholder="Message" rows='10' cols='90'></textarea><br>
			<input type="submit" name="contact">
		</form>
		<?php if(isset($_POST['contact'])){
			extract($_POST);
			if (!empty($nom && $email && $tel && $sujet && $content)) {
				if (preg_match("%^[a-z A-Z]+$%", $nom)&&preg_match('%^[\w.]+@[a-zA-Z]+.[a-zA-Z]{2,6}$%', $email) && preg_match('%^((\+[0-9]{2})|0)[0-9]{9}$%', $tel)) {
					$q = $db->prepare('INSERT INTO message(name, motif, content, email, phone) VALUES (:name, :motif, :content, :email, :phone)');
					$q->execute([
						'name' => $nom,
						'motif' => $sujet,
						'content' => $content,
						'email' => $email,
						'phone' => $tel,
					]);
					if(mail('vaxelaire.yohe@gmail.com', $sujet, $content .' fait par '.$nom.' email : '. $email . ' tel : '.$tel)){
						echo '<div class="success">mail envoyer</div>';
					}else echo '<div class="error">mail non-envoyer</div>';
					echo '<div class="success">Requete envoyer</div>';
				}else{
					echo '<div class="error">Veuillez remplir correctement les champs!</div>';
				}
			}else{
				echo '<div class="error">Veuillez remplir tous les champs!</div>';
			}
		} ?>
	</div>
	<?php include 'includes/copy-right.php' ?>
</body>
</html>
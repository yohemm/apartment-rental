<?php if (!isset($db))include 'database.php'; ?>

<form method="post">
	<h3>Inscription De Nouveau Admin:</h3>

	<?php 
		if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_retype'])) { // si les donner son pas vide

			// enregistre les variables de maniere securiser
			$pseudo = preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', htmlspecialchars($_POST['pseudo']));
			$password = preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', htmlspecialchars($_POST['password']));
			$password_retype = preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', htmlspecialchars($_POST['password_retype']));

			// regarde si un pseudo existe deja a se nom dans lka base
			$check = $db->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?');
			$check->execute(array($pseudo));
			$data = $check->fetch();

			$row = $check->rowCount();

			if ($row <= 0) { # si un pseudo existe
				if (strlen($pseudo) <= 20) { # longeur du nom < 100
					if ($password == $password_retype) { # similariter des pass
						$ip = $_SERVER['REMOTE_ADDR'];

						#creation du compte
						$insert = $db->prepare('INSERT INTO admin(pseudo, password, ip) VALUES(:pseudo, :password, :ip)');
						var_dump($insert);
						var_dump(hash_hmac('sha256', $password, "appart2fou"));
						var_dump($insert->execute([
							'pseudo' => $pseudo,
							'password' => hash_hmac('sha256', $password, "appart2fou"),
							'ip' => $ip]));

						echo '<div class="success">Inscription reussit</div>';
					}else header('location:index.php?inscription_err=password');
				}else header('location:index.php?inscription_err=pseudo');
			}else header('location:index.php?inscription_err=already');
		}
 	?>
	<input type="text" name="pseudo" placeholder="Votre pseudo..." autocomplete="off">
	<input type="password" name="password" placeholder="Votre mot de passe..." autocomplete="off">
	<input type="password" name="password_retype" placeholder="Votre mot de passe..." autocomplete="off">
	<input type="submit" name="btn" value="Inscription">
</form>
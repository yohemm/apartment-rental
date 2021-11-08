<?php include 'database.php'; ?>
<form method="post">
	<h3>Inscription Admin:</h3>

	<?php 
		if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_retype'])) { // si les donner son pas vide

			// enregistre les variables de maniere securiser
			$pseudo = mysqli_escape_string(htmlspecialchars($_POST['pseudo']));
			$password = mysqli_escape_string(htmlspecialchars($_POST['password']));
			$password_retype = mysqli_escape_string(htmlspecialchars($_POST['password_retype']));

			// regarde si un pseudo existe deja a se nom dans lka base
			$check = $db->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?');
			$check->execute(array($pseudo));
			$data = $check->fetch();

			$row = $check->rowCount();

			if ($row <= 0) { # si un pseudo existe
				if (strlen($pseudo) <= 100) { # longeur du nom < 100
					if ($password == $password_retype) { # similariter des pass

						$password = hash('sha256', $password); #hashage
						$ip = $_SERVER['REMOTE_ADDR'];

						#creation du compte
						$insert = $db->prepare('INSERT INTO admin(pseudo, password, ip) VALUES(:pseudo, :password, :ip)');
						$insert->execute(array(
							'pseudo' => $pseudo,
							'password' => $password,
							'ip' => $ip));

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
<?php include 'database.php'; ?>
<form method="post">
	<h3>Inscription Admin:</h3>
	<?php 
		if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_retype'])) {
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$password = htmlspecialchars($_POST['password']);
			$password_retype = htmlspecialchars($_POST['password_retype']);

			$check = $db->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?');
			$check->execute(array($pseudo));
			$data = $check->fetch();

			$row = $check->rowCount();

			if ($row <= 0) {
				if (strlen($pseudo) <= 100) {
					if ($password == $password_retype) {
						$password = hash('sha256', $password);
						$ip = $_SERVER['REMOTE_ADDR'];

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
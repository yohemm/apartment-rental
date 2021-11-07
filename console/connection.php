<?php 
	if (isset($_POST['pseudo']) && isset($_POST['password'])) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$password = htmlspecialchars($_POST['password']);

		$check = $db ->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?');
		$check->execute(array($pseudo));

		$data = $check->fetch();

		$row = $check->rowCount();
		if ($row >= 1) {
			$password = hash('sha256', $password);

			if ($data['password'] === $password) {
				$_SESSION['admin'] = $data['pseudo'];
				header('location:index.php');
			}else header('location:index.php?login_err=password');
		}else header('location:index.php?login_err=pseudo');
	}
 ?>

<form method="post">
	<h3>Connection :</h3>
	<input type="text" name="pseudo" placeholder="Votre pseudo..." autocomplete="off">
	<input type="password" name="password" placeholder="Votre mot de passe..." autocomplete="off">
	<input type="submit" name="btn" value="Connection">
</form>
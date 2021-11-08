<?php 
	if (isset($_POST['pseudo']) && isset($_POST['password'])) { #si les champs son rempli
		$pseudo = mysqli_escape_string(htmlspecialchars($_POST['pseudo'])); #securiter
		$password = mysqli_escape_string(htmlspecialchars($_POST['password'])); #securiter

		// recupere la base de donner (pseudo et pass) qui correspond au pseudo
		$check = $db ->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?'); # 
		$check->execute(array($pseudo));

		$data = $check->fetch();

		// compte le nombre de resulta
		$row = $check->rowCount();

		if ($row >= 1) {#si il y a un pseudo qui correspond

			$password = hash('sha256', $password); #hash les mot de pass (securiter)

			if ($data['password'] === $password) { # si les 2 hash corresponde
				$_SESSION['admin'] = $data['pseudo']; #crée une nouvelle session de connection
				header('location:index.php'); # renvoi sur l'index
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
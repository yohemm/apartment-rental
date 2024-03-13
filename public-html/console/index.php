<?php 
session_start();
include_once 'database.php';
global $db; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../includes/style.css">
	<link href="images/favicon.ico" rel="shortcut icon" type="image/ico" />
	<?php include '../includes/header.php' ?>
	<script type="text/javascript"> 
		setInterval(Change_title, 100);
		text += ' | ADMIN | ';
	</script>
</head>
<body>
	<div id="content">
		<a href="../index.php" id="back_btn"><img src="../images/back_arrow.png" width="40px" alt="slider d'images"></a>
		<h1 style="text-align: center;">ADMIN</h1>
		<?php 
		if (isset($_GET['login_err'])) {
			$err = htmlspecialchars($_GET['login_err']);

			switch ($err) {
				case 'password':
					?><div class="error">Mots de passe inccorecte</div> <?php
					break;
				
				case 'pseudo':
					?><div class="error">Pseudo inccorecte</div> <?php
					break;

				default:
						?><div class="error">Erreur inconu</div> <?php

					break;
			}
		}

		if (isset($_GET['inscription_err'])) {
			$err = htmlspecialchars($_GET['inscription_err']);

			switch($err){
				case 'password':
					?><div class="error">Le mots de passe de correspond pas un deuxieme </div> <?php
					break;

				case 'pseudo':
					?><div class="error">Pseudo trop long</div> <?php
					break;

				case 'already':
					?><div class="error">Le pseudo existe deja</div> <?php
					break;

				default:
					?><div class="error">Erreur inconu</div> <?php
					break;
			}
		}
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) { ?>
		<div id="admin-content">
			<div id="frist-content"><?php include 'contactview.php'; 
			include 'add_planning.php'; ?></div>
			<div id="second-content"><?php include 'inscription.php';
			include 'create_page.php'; ?></div>
			<div id="third-content"><?php include 'modify_page.php'; ?></div>
		 </div>
		<?php }else {
			include'connection.php';
		} ?>
	 </div>
</body>
</html>
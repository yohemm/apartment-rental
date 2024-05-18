<?php
function connectionForm(){
	$connction ="
	<form method='post'>
	<h3>Connection :</h3>
	<input type='text' name='pseudo' placeholder='Votre pseudo...' autocomplete='off'>
	<input type='password' name='password' placeholder='Votre mot de passe...' autocomplete='off'>
	<input type='submit' name='btn' value='Connection'>
	</form>
	";
	// echo $connction;
	return $connction;
}
function verifyConnection(PDO $db){
	include_once 'redirection.php';
	// if(!isset($_SESSION))session_start();
	// if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
	if (isset($_POST['pseudo']) && isset($_POST['password'])) { #si les champs son rempli
		$pseudo = preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', htmlspecialchars($_POST['pseudo'])); #securiter
		$password = preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', htmlspecialchars($_POST['password'])); #securiter
		
		// recupere la base de donner (pseudo et pass) qui correspond au pseudo
		$check = $db ->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?'); # 
		$check->execute(array($pseudo));
		
		$data = $check->fetch();
		
		// compte le nombre de resulta
		$row = $check->rowCount();
		
		if ($row >= 1) {#si il y a un pseudo qui correspond
			$password = hash_hmac('sha256', $password, "appart2fou"); #hashage
			
			
			if ($data['password'] === substr($password,0, strlen($data['password']))) { # si les 2 hash correspondex
				$_SESSION['admin'] = $data['pseudo']; #crée une nouvelle session de connection
				redirect('console/index.php');
			}else {
				redirect('console/index.php?login_err=password');
			}
		}else {
			redirect('console/index.php?login_err=pseudo');
		}
	}
}
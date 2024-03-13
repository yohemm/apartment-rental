<?php 
	
	include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/function.php';
	include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/console/database.php';
	global $db;
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/header.php' ?>
	<script type="text/javascript"> 
		setInterval(Change_title, 100); // appelle la fonction Change_title tout les 0.1s
		text += ' | HEBERGEMENT | ';
	</script>
</head>
<body>
	<?php include "includes/menu-nav.php" ?>
	<div id="content">
		<div id="hebergement">
		<?php
			include_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/includes/carrouselle.php";
			if (isset($_GET['name'])) { // verifie que le que la variable n'est pas vide
				
				$page = getVisible($_GET['name']);
				$files = glob('images/'.$page->id.'/car-*.*');
				generateCarousselle($files);
				$price = $page->price;?>
				<h1 id="name_hebergement"><?= $page->name?> </h1>
				<div id='hebergement-unique-content'>
					<h2 id="desc_hebergement"><?= $page->description?> </h2>
					<?php 
					$alert = getAlert($page->alert);
					if($alert != null){
					?>
					<div class="info-alert">
						<div class="info-text">
							<p><?= $alert->content ?></p>
						</div>
					</div>
					<?php 
						}
					?>
					<p><?php 

					// remplace mots clef par les variable ou balise
					$page->content = str_replace("price",$price."€",$page->content);
					$page->content = str_replace("name",$_GET['name'],$page->content);
					$page->content = str_replace("\n",'<br/>',$page->content);
					// $page->content = str_replace("endimg",'" width="500px"" height="250px"/>',$page->content);
					// $page->content = str_replace("img",'<img alt="photo logement" class="img_hebergement"src="',$page->content);
					echo $page->content;/*affiche la desccri^ption*/
					?></p>
				</div>
				<div id='hebergement-common-content'>
					<p>Hébergement pour une durée de <?= $page->minimum_night?> jours minimum, pouvant accueillir <?= $page->maximum_personnes?> personnes.</p>
					<p>À partir de <?= $price?>€* par jour.</p>
					<p class="litle">*Le prix est à titre indicatif et peut varier en fonction des saisons.</p>
				</div>
				<?php
			}
			if (isset($_POST['horraire'])) {
				if (!empty($_POST['arriver'] && $_POST['depart'])) {

					/*verifie le format de la date*/
					if (preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $_POST['arriver']) && preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $_POST['depart'])) {
						if (Order_date($_POST['arriver'], $_POST['depart'])) {/*verifier que les horraire soit dans l'ordre*/

							$date_disponible = verifyDateDispo($page->id, $_POST['arriver'], $_POST['depart']);

							if ($date_disponible) {?>
								<h3 class=resulte_date>Vos créneaux horraires du <?= $_POST['arriver']?> au <?= $_POST['depart']?> sont disponible veuillez nous contacter pour réserver... </h3>
							<?php }else{?>
								<h3 class=resulte_date>Vos créneaux horraires du <?= $_POST['arriver']?> au <?= $_POST['depart']?> sont actuellement indisponible... </h3>
							<?php } ?>
						<?php }else{?>
							<div class="error">Veuillez mettre les dates dans le bonne ordre</div>		
						<?php }
					}
				}else{ ?>
								<div class="error">Veuillez remplir tous les champs!</div>					
				<?php }
			}
		if (isset($_GET['name'])){
		 ?>


		<h3>Voir les dates disponnible:</h3>
		<form method="post" id="found_date">
			<input type="date" name="arriver" required="">
			<input type="date" name="depart" required="">
			<input type="submit" name="horraire">
		</form>
		<p class="litle">*Ce formulaire est juste à titre informatif, <a href="contacts.php">veuillez contacter la boutique pour réserver.</a></p>
		</div>
		<?php }else{
				include 'includes/all_hebergement.php';
			}
			include 'includes/copy-right.php' ?>
	</div>
</body>
</html>
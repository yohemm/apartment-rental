<?php 
	include 'includes/function.php';
	include 'console/database.php'; 
	global $db;
?>
<!DOCTYPE html>
<html>
<head>
	<?php include'includes/header.php' ?>
	<script type="text/javascript"> 
		setInterval(Change_title, 100); // appelle la fonction Change_title tout les 0.1s
		text = 'Vosges dans le vent | HEBERGEMENT '; // title
	</script>
</head>
<body>
	<?php include "includes/menu-nav.php" ?>
	<div id="content">
		<div id="hebergement">
		<?php
			if (isset($_GET['name'])) { // verifie que le que la variable n'est pas vide
				$name_dict = ['tiny' => 'Tiny House',
				'maison'=>'Maison Brésaude',
				'aparte'=>'Apartement La Bresse',
				'gite'=>'Le gite des Pouhas'];
				$name = $_GET['name'];
				//prend les donner de la base de maniere securiser
				$req = $db -> query("SELECT * FROM `house` WHERE name ='".$name."'");
				$page = $req -> fetchObject(); 
				$price = $page->price;?>
				<h3 id="name_hebergement"><?= $name_dict[$name]?></h3><!-- affiche le nom long du dans le dict -->
				<p><?php 

					// remplace mots clef par les variable ou balise
					$page->description = str_replace("price",$price."€",$page->description);
					$page->description = str_replace("name",$name_dict[$name],$page->description);
					$page->description = str_replace("\n",'<br/>',$page->description);
					$page->description = str_replace("endimg",'" width="500px"" height="250px"/>',$page->description);
					$page->description = str_replace("img",'<img alt="photo logement" class="img_hebergement"src="',$page->description);
					echo $page->description;/*affiche la desccri^ption*/
				?></p>

				<p>Le prix moyen est de <?= $price?>€/par jour</p>
				<?php
			}
			if (isset($_POST['horraire'])) {
				if (!empty($_POST['arriver'] && $_POST['depart'])) {
					/*verifie le format de la date*/
					if (preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $_POST['arriver']) && preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $_POST['depart'])) {
						if (Order_date($_POST['arriver'], $_POST['depart'])) {/*verifier que les horraire soit dans l'ordre*/
								$query = $db->query("SELECT `house`.name, `reservation`.date_arriver, `reservation`.date_depart FROM `house` JOIN `reservation` ON `house`.name = `reservation`.hebergement WHERE `house`.name = '$name'");
							$all_reservations = $query->fetchALL();
							$date_disponible = false;

							// verifie la diponibilité des date
							foreach ($all_reservations as $reservation) {
								if (Order_date($reservation[1], $_POST['arriver'] )) {
									if (Order_date($reservation[2], $_POST['arriver'])) {
										$date_disponible = true;
									}
								}else{
									if (Order_date($_POST['depart'],$reservation[2])) {
										$date_disponible = true;
									}
								}
							}
							if ($date_disponible) {
								echo "<h3 class=resulte_date>Vos créneaux horraires du ".$_POST['arriver']." au ".$_POST['depart']." sont disponible veuillez nous contacter pour réserver... </h3>";
							}else{
								echo "<h3 class=resulte_date>Vos créneaux horraires du ".$_POST['arriver']." au ".$_POST['depart']." sont actuellement indisponible... </h3>";
							}
						}else{
							echo '<div class="error">Veuillez mettre les dates dans le bonne ordre</div>';		
						}
					}
				}else{
								echo '<div class="error">Veuillez remplir tous les champs!</div>';					
				}
			}
		if (isset($_GET['name'])){
		 ?>


		<h3>Voir les dates disponnible:</h3>
		<form method="post" id="found_date">
			<input type="date" name="arriver" required="">
			<input type="date" name="depart" required="">
			<input type="submit" name="horraire">
		</form>
		<p class="litle">*Ce formulaire est juste à titre informatif, veuillez contacter la boutique pour réserver</p>
		</div>
		<?php }else{
				include 'includes/all_hebergement.php';
			}
			include 'includes/copy-right.php' ?>
	</div>
</body>
</html>
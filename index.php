<!DOCTYPE html>
<html>
<head>
	<?php include'includes/header.php' ?>
	<script type="text/javascript"> 
		setInterval(Change_title, 100);
		text += ' | ACCUEIL | ';
	</script>
</head>
<body>
	<?php include "includes/menu-nav.php" ?>
	<div id="content">
		<?php include "includes/carrouselle.php";
		generateCarousselle(["images/tiny-house.jpg", "images/20210808_200312.jpg", "images/20210808_200104.jpg", "images/20210808_200350.jpg", "images/20210808_200350.jpg"]);
		$page = getPage('accueil');
		?>

		<h1><?= $page->title ?></h1>

		<?php
		if($page->sub_title!=''){
			echo '<h2>'.$page->sub_title.'</h2>';
		}
		$alert = getAlert($page->alert);
		if($alert != null){
		?>
		<div class="info-alert">
			<div class="info-text">
				<p><?= $alert->content ?></p>
				<!-- <p>10% de réduction pour l'<a href="./hébergement.php?name=appartement%20la%20bresse">apartement la semaines du 15</a></p> -->
			</div>
		</div>
		<?php 
			}
		?>
		
		<?= $page->content ?>
		<!-- <h3>Idéal pour des vacances dans l''esprit montagne et sportif</h3><p>L'équipe vous souhaites la bienvenue. </p><p>Location de maison sur Gérardmer, la Bresse et ses alentoure. Pour petite familles et grande famille.</p> -->
		<!-- <div id="house_recommender">
			<div class="nb_personne">
				<label for="personne">Locataire :</label>
				<input type="range" name="personne" id="personne" min="1" max="15" value="1" step="1" oninput="this.nextElementSibling.value = this.value" onchange="Resultor()">
				<output>1</output>
			</div>
			<div class="time">
				<select name="temps" id="temps" onchange="Resultor()" >
					<option value="0">Jours ...</option>
					<option value="1">Journalier(1 à 7 jour)</option>
					<option value="2">Semestrielle(1 à 3 semaine)</option>
					<option value="3">Longterme(plus de 3 semaine)</option>
				</select>
			</div>
			<div id="search_resulte">
			</div>

		</div> -->
		<script type="text/javascript">
			setInterval("mouveSlide(1)", 4000);
			// Resultor();</script>
		<?php include "includes/all_hebergement.php" ?>
	</div>
	<?php include 'includes/copy-right.php' ?>
</body>
</html>
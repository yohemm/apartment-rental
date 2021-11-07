<!DOCTYPE html>
<html>
<head>
	<?php include'includes/header.php' ?>
	<script type="text/javascript"> 
		setInterval(Change_title, 100);
		text = 'Vosges dans le vent | ACCEUIL ';
	</script>
</head>
<body>
	<?php include "includes/menu-nav.php" ?>
	<div id="content">
		<script type="text/javascript">
			// var houses = {
			// 	'<a class="result" href="hébergement.php?name=tiny">tania House</a>': [[1,2],[1,2]],
			// 	'<a class="result" href="hébergement.php?name=maison">Maison brésaude</a>': [[3,15],[2,3]],
			// 	'<a class="result" href="hébergement.php?name=aparte">L\'aparte brésaud</a>': [[1,4],[1,2]],
			// 	'<a class="result" href="hébergement.php?name=gite">Le gite des pouhas</a>': [[4,15],[1,2]],
			// };

			// function Resultor(){
			// 	var temps = document.getElementById('temps').value;
			// 	var personne = document.getElementById('personne').value;
			// 	var result = []
			// 	var modify = document.getElementById('search_resulte');
			// 	for (let house in houses){
			// 		for (var i = houses[house][0][0]; i <= houses[house][0][1]; i++) {
			// 			if (personne == i) {
			// 				if (temps != 0) {
			// 					for (var j = houses[house][1][0]; j <= houses[house][1][1]; j++) {
			// 						if (temps == j) {result.push(house)}
			// 						}
			// 				}
			// 				else{
			// 					result.push(house)
			// 				}
			// 			}
			// 		}
			// 	}
			// 	if (!result.length > 0) {
			// 		result = "Pas de logement trouver selon vos critere";
			// 	}
			// 	modify.innerHTML = result;
			// }





			// SLIDER D'IMAGE
			function slideRefresh(){
				// remet au dernier si le nombre et negatif
				if (slide_id < 0) {
					slide_id = slide.length - 1;
				}

				// remet a 0 si l'id est trop grznd
				if (slide_id > slide.length - 1) {
					slide_id = 0;
				}
				// les point en dessous de l'image
				var dots = document.getElementsByClassName('dot');
				// la dots active
				var actives = document.getElementsByClassName('active');

				// pour tt les dot on enlever le fait que elle soit selectionner
				for (var i = 0; i < actives.length; i++) {
					actives[i].classList.remove('active');
				}

				// ajoute active a la dots et change l'image
				document.getElementById('slide').src = slide[slide_id];
				dots[slide_id].classList.add('active');
			}


			// changer avec les fleche
			function mouveSlide(mouve){
				slide_id += mouve;

				slideRefresh();
			}


			// change avec les dots
			function changeSlide(id){
				slide_id = id;

				slideRefresh();
			}

			// Les images
			var slide = new Array("images/tiny-house.jpg", "images/20210808_200312.jpg", "images/20210808_200104.jpg", "images/20210808_200350.jpg");

			var slide_id = 0;
		</script>
		<div id="slider">
			<img id="slide" alt="slider d'images" src="images/tiny-house.jpg" >
			<div id="prev" onclick="mouveSlide(-1)">❮</div>
			<div id="next" onclick="mouveSlide(1)">❯</div>
		</div>
		<div style="text-align: center;">
			<span class="dot" class="active" onclick="changeSlide(0)"></span>
			<span class="dot" onclick="changeSlide(1)"></span>
			<span class="dot" onclick="changeSlide(2)"></span>
			<span class="dot" onclick="changeSlide(3)"></span>
		</div>

		<br>

		

		<p>L'équipe vous souhaites un bienvenue. <br>Location de maison sur Gérardmer, la Bresse et ses alentoure. Pour petite familles et grande famille.
		</p>
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
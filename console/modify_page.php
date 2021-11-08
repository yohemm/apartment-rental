<?php 
		// recuperation des donner
		$req = $db->query('SELECT * FROM house');
		$houses = $req->fetchALL();?>


		<h2>Consigne d'utilisation:<br>
			<ul>
				<li>'price' renvoi le prix avec '€' a la fin</li>
				<li>'name' renvoi le nom de la page</li>
				<li>'img'le lien'endimg' affiche une image dans un belle encadré</li>
			</ul>
		</h2>


		<?php
		foreach ($houses as $house) {
			// simplification des variable
			$name = $house['name']; 
			$content = $house['description'];
			$price = $house['price'];

			// affiche le formulaire
			print("<form method='post' class='house_modify'>
					<h2>".strtoupper($name." :")."</h2>
				 	<h3>Nom de la base de donné : </h3>
				 	<input type='text' name='name_".$name."' value='".$name."' required=''>
				 	<h3>Contenue : </h3>
				 	<textarea name='content_".$name."' rows='10' cols='90' required=''>".$content."</textarea>
				 	<h3>Prix : </h3>
				 	<input type='texts' name='price_".$name."' required='' value='".$price."'><br>
				 	<input type='submit' name='btn_".$name."'>
			 	</form>");

			if (isset($_POST['btn_'.$name])) { //si on appui sur le btn
				if (!empty($_POST['name_'.$name] && $_POST['content_'.$name] && $_POST['price_'.$name])) { // si les donner son pas vide

					// si le nom a changer on le change
					if($name != $_POST['name_'.$name]){
						$q = $db->prepare("UPDATE house SET name = :name WHERE name ='$name'");
						$q->execute(['name' => $_POST['name_'.$name]]);
						echo $_POST['name_'.$name];
					}

					// si le contenu a changer on le change
					if($content != $_POST['content_'.$name]){
						$q = $db->prepare("UPDATE house SET description = :content WHERE name ='$name'");
						$q->execute(['content' => $_POST['content_'.$name]]);
						echo $_POST['content_'.$name];
					}

					// si le prix a changer on le change
					if($price != $_POST['price_'.$name]){
						$q = $db->prepare("UPDATE house SET price = :price WHERE name ='$name'");
						$q->execute(['price' => $_POST['price_'.$name]]);
						echo $_POST['price_'.$name];
					}
					echo '<div class="success">Page modifié</div>';
				}else{
					echo '<div class="error">Veuillez remplir tous les champs!</div>';
				}
			}
		} ?>
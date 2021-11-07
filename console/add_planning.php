<?php 
		include '../includes/function.php';
		$req = $db->query("SELECT name FROM house");
		$houses_name = $req->fetchALL();
		$name_dict = ['tiny' => 'Tiny House',
			'maison'=>'Maison Brésaude',
			'aparte'=>'Apartement La Bresse',
			'gite'=>'Le gite des Pouhas'];
		?>		
		<form method="post" id="add_planning">
			<h2>Ajouter un horraire sur le planning:</h2>
			<?php if (isset($_POST['horraire'])) {
			extract($_POST);
			if (!empty($arriver && $depart && $hebergement)) {
				if (preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $arriver) && preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $depart)) {
					$house_name_bool = false;
					foreach ($houses_name as $house) {
						if ($hebergement == $house[0]) {
							$house_name_bool = true;
						}
					}
					if ($house_name_bool) {
						if (Order_date(date('Y-m-d'), $arriver)) {
							if (Order_date($arriver, $depart)) {
								$q = $db->prepare('INSERT INTO reservation(date_arriver, date_depart, hebergement) VALUES (:depart, :arriver, :hebergement)');
								$q ->execute([
									':arriver' => $arriver,
									':depart' => $depart,
									':hebergement' => $hebergement]);
								echo '<div class="success">Ajout au plannig réussit</div>';
							}else{
								echo '<div class="error">Les dates doivent etre mis dans l\'ordre</div>';
							}
						}else{
							echo '<div class="error">Les dates doivent etre dans le futur</div>';
						}	
					}else{
						echo '<div class="error">La maison selectionner de correspond pas</div>';
					}
				}else{
					echo '<div class="error">Les dates doivent etre ecrite au format : ****-**-**</div>';
				}
			}else{
				echo '<div class="error">Veuillez remplir tous les champs!</div>';
			}
		} ?>
			<input type="date" name="arriver" required="">
			<input type="date" name="depart" required="">
			<select name="hebergement">
				<?php foreach ($houses_name as $house) {
					$houses_name = $house[0];
					if ($name_dict[$houses_name]) {
						echo "<option value='$houses_name'>$name_dict[$houses_name]</option>";
					}else{
						echo "<option value='$houses_name'>$houses_name</option>";
					}
				} ?>
				
			</select>
			<input type="submit" name="horraire">
		</form>
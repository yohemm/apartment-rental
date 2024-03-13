<?php 
		if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
		include '../includes/function.php';
		
		$houses = $db->query("SELECT * FROM  get_house_paire_name_id()")->fetchALL()
		?>	

		<form method="post" id="add_planning">
			<h2>Bloqué des dates sur le planing :</h2>

			<?php if (isset($_POST['horraire'])) { # verifie que l'on a envoyer les horraire
			extract($_POST);
			if (!empty($arriver && $depart && $hebergement)) { #voir si le resultat des horrraires n'est pa vide
				if (preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $arriver) && preg_match('%^20[0-9]{2}-[01][0-9]-[0-3][0-9]$%', $depart)) { # verifie que la date est au bon format

					
						if (Order_date(date('Y-m-d'), $arriver)) { # verifie que la date n'est pas passer
							if (Order_date($arriver, $depart)) { #function dans function.php
								if(verifyDateDispo($hebergement, $arrive, $depart)){
									// reserve la date
									$q = $db->prepare('INSERT INTO reservation(starting_date, end_date, house) VALUES (:arriver, :depart, :hebergement)');
									$q ->execute([
										':arriver' => $arriver,
										':depart' => $depart,
										':hebergement' => $hebergement]);
	
									echo '<div class="success">Ajout au plannig réussit</div>';

								}else{

									echo '<div class="error">La date est déjà prise</div>';
								}
							}else{
								echo '<div class="error">Les dates doivent etre mis dans l\'ordre</div>';
							}
						}else{
							echo '<div class="error">Les dates doivent etre dans le futur</div>';
						}
				}else{
					echo '<div class="error">Les dates doivent etre ecrite au format : ****-**-**</div>';
				}
			}else{
				echo '<div class="error">Veuillez remplir tous les champs!</div>';
			}
		} ?>
			<input type="date" name="arriver" required="" value="<?=date('Y-m-d') ?>">
			<input type="date" name="depart" required="">
			<select name="hebergement">
				<?php foreach ($houses as $house) {
					echo "<option value='$house[1]'>$house[0]</option>";
				} ?>
				
			</select>
			<input type="submit" name="horraire">
		</form>
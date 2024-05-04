	 <form method="post" name="">
	 	<h2>Nouvelle page :</h2>
	 	<?php if (isset($_POST['btn_create_page'])) { # donné envoyer
				if (!empty($_POST['name'] && $_POST['content'] && $_POST['price'])) { # donner pas vide

					// envoi les donner de maniere securiser
					$q = $db->prepare('INSERT INTO house (name, description, price) VALUES  (:name, :description, :price)');
					$q ->execute([
						'name' => $_POST['name'],
						'description' => $_POST['content'],
						'price' => $_POST['price']]);
					echo '<div class="success">Nouvelle page créé</div>';
				}
			} ?>

	 	<h3>nom : </h3>
	 	<input type="text" name="name" required="">
	 	<h3>Contenue : </h3>
	 	<textarea name="content" rows="10" cols="90" required=""></textarea>
	 	<h3>Prix : </h3>
	 	<input type="text" name="price" required=""> <br>
	 	<input type="submit" name="btn_create_page">
	 </form>
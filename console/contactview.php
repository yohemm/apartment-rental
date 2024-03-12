<?php 

		if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
		// recupere les donner dans l'ordre du plus resen au plus vieux
		$req = $db -> query("SELECT * FROM message ORDER BY id DESC");
		$CONTACTS = $req ->fetchALL();

		echo "<h2>Liste des messages:</h2>";


		foreach ($CONTACTS as $contact) : ?>
			<div class="contactTitle">
				<h3><?= $contact['motif'] ?></h3> # met le motif en titre
				<p class="contactContent"><?php

				# affiche les 30 premier caractere si il y en a plus
				if (strlen($contact['content']) > 30) {
					echo substr($contact['content'], 0, 30); ?>
						...<br> 
						<a href="one_contact.php?id=<?= $contact['id'] ?>">voir plus</a>
				<?php }else{
					echo $contact['content']; }?>
				</p>
				<p>tél : <?= $contact['phone']?> <br>email : <?= $contact['email'] ?></p> # donne le reste desinfo
				<p class="detaille">par <?= $contact['name']?>, à <?= $contact['date']?></p>
				
			</div>
		<?php
		endforeach; ?>
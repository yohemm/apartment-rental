<?php 
		$req = $db -> query("SELECT * FROM message ORDER BY id DESC");
		$CONTACTS = $req ->fetchALL();
		echo "<h2>Liste des messages:</h2>";
		foreach ($CONTACTS as $contact) : ?>
			<div class="contactTitle">
				<h3><?= $contact['motif'] ?></h3>
				<p class="contactContent"><?php
				if (strlen($contact['content']) > 30) {
					echo substr($contact['content'], 0, 30); ?>
						...<br>
						<a href="one_contact.php?id=<?= $contact['id'] ?>">voir plus</a>
				<?php }else{
					echo $contact['content']; }?>
				</p>
				<p>tél : <?= $contact['phone']?> <br>email : <?= $contact['email'] ?></p>
				<p class="detaille">par <?= $contact['name']?>, à <?= $contact['date']?></p>
				
			</div>
		<?php
		endforeach; ?>
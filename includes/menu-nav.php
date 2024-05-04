		<nav>
			<ul id="main-menu">
				<li><a href="index.php">accueil</a></li>
				<li class="menu-deroulant">
					<a href="hébergement.php">hébergements</a>
					<ul class="sous-menu">
						<?php
							include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/console/database.php';
							$req = allVisible();
							foreach($req as $house){echo "<li><a href='hébergement.php?name=".$house['name']."'>".$house['name']."</a></li>";};
							?>
					</ul>
				</li>
				<li>
					<a href="https://www.vosges-dans-le-vent.com/" target="_blank">activités</a>
				</li>
				<li>
					<a href="contacts.php">contact</a>
				</li>
			</ul>
		</nav>
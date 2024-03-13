<div id="list_houses">
	<?php 
		include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/console/database.php';
		$imgsById = [];	
		foreach(allVisible() as $house){
			$mains = glob('./images/'.$house['id']."/". 'main.{jpg,jpeg,png,gif,avif,webp}', GLOB_BRACE);
			if(count($mains) >= 1){
				$imgsById[$house['id']] = $mains[0]; ?>
				<div class="house_case" style="background-image: url('<?=$mains[0] ?>');">
						<a href="hébergement.php?name=<?= $house['name']?>"><h3><?= $house['name']?></h3><p>1 à <?= $house['maximum_personnes']?> personnes</p></a>
				</div>
			<?php
			}
		}
	?>
</div>
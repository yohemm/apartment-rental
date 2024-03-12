<?php 
if($_SERVER['REQUEST_URI'] == '/'.substr(__FILE__, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])))header('location:/');
function getExtension(string $folderName ){
	return end(explode('.', $folderName));
}
function uploadImg(string $tmpFilePath, string $id, string $name ){
	//A file path needs to be present
	if ($tmpFilePath != ""){
		if(!is_dir("../images/".$id."/")) mkdir("../images/".$id."/", 0777, true);
		//Setup our new file path
		$newFilePath = "../images/".$id."/". $name;
		echo $newFilePath;
		//File is uploaded to temp dir
		if(move_uploaded_file($tmpFilePath, $newFilePath)) {
			//Other code goes here
		}
	}
}
function uploadImgs(string $inputName, string $id, string $prefix="" ){
	if(isset($_FILES[$inputName])){
		$total_count = count($_FILES[$inputName]['name']);
		$nb = 0;
		for( $i=0 ; $i < $total_count ; $i++ ) {
			//The temp file path is obtained
			$tmpFilePath = $_FILES[$inputName]['tmp_name'][$i];
			// var_dump($_FILES[$inputName]['name'][$i]);
			$extension =getExtension($_FILES[$inputName]['name'][$i]);
			do{
				$name = ($prefix==""?$nb:$prefix."-".$nb).".".$extension;
				$nb++;
			}while(file_exists("../images/".$id."/".$name));
			// echo $tmpFilePath ."     ".$nb;
			uploadImg($tmpFilePath, $id, $name);
		 }
	}
}
// recuperation des donner
$houses = allLocation();

$accueil = getPage('accueil');

include 'manage_alert.php';

if (isset($_POST['accueil'])) { //si on appui sur le btn
	if (!empty($_POST['title'] && $_POST['sub_title'] && $_POST['content'])) { // si les donner son pas vide
		// si le nom a changer on le change
		updateSingle('page', 'accueil', 'title', 'title', $accueil->title);
		updateSingle('page', 'accueil', 'sub_title', 'sub_title', $accueil->sub_title);
		updateSingle('page', 'accueil', 'content', 'content', $accueil->content);
		echo '<div class="success">Page modifié</div>';
	}else{
		echo '<div class="error">Veuillez remplir tous les champs!</div>';
	}
}
?>

<form method="post">
	<div>
		<label for="title"></label>
		<textarea name="title" id="title" cols="30" rows="10"><?= $accueil->title ?></textarea>
		<label for="sub_title"></label>
		<textarea name="sub_title" id="sub_title" cols="30" rows="10"><?= $accueil->sub_title ?></textarea>
		<label for="content"></label>
		<textarea name="content" id="content" cols="30" rows="10"><?= $accueil->content ?></textarea>
	</div>
	<button type="submit" name="accueil">Changer l'accueil</button>
</form>

<h2>Consigne d'utilisation:</h2>
<ul>
	<li>'price' : renvoi le prix avec '€' a la fin</li>
	<li>'name' : renvoi le nom de la page</li>
</ul>
<h1>/!\ alignement des titres non dévelloper</h1>
<h1>/!\ Formulaire accueil + alertenon dévelloper</h1>

<?php 

$allImgsHouses = [];
foreach ($houses as $house) {
	// simplification des variable
	$name = $house['name']; 
	$content = $house['content'];
	$price = $house['price'];
	$visible = $house['visible'];
	$description = $house['description'];
	$minimumNight = $house['minimum_night'];
	$maximumPersonnes = $house['maximum_personnes'];
	$id = $house['id'];
	$folder = '../images/'.$house['id']."/";
	$allImgsHouses[$id] = glob($folder . '*.{jpg,jpeg,png,gif,avif,webp}', GLOB_BRACE);
	$imageMain = glob($folder . 'main.{jpg,jpeg,png,gif,avif,webp}', GLOB_BRACE);
	$imagesCar = glob($folder . 'car-*.{jpg,jpeg,png,gif,avif,webp}', GLOB_BRACE);
	$images = array_diff($allImgsHouses[$id], $imagesCar, $imageMain);



	// affiche le formulaire
	?>
	<form method='post' class='house_modify' enctype='multipart/form-data'>
		<h2><?=strtoupper($name." :")?></h2>
		<h3>Nom : </h3>
		<input type='text' name='name_<?=$id?>' value='<?=$name?>' required=''>
		<h3>Visible : </h3>

		<input type='checkbox' name='visible_<?=$id?>' <?=($visible?"checked":"")?>>
		<h3>Image Principal : </h3>
		<label for=''></label>
		<input type='file' id='' title='principal' name='main_<?=$id?>'  accept='image/png, image/gif, image/jpeg, image/avif, image/webp'>
		<h3>Image Du carrousel : </h3>
		<label for=''></label>
		<input type='file' id='' title='carrousel' name='carrousel_<?=$id?>[]'  accept='image/png, image/gif, image/jpeg, image/avif, image/webp'  multiple='multiple'>
	<?php
	foreach($imagesCar as $image){
		echo("<a href='delete-img.php?img=$image'> <img src='$image' height='50'/> </a>");
	}?>
	<h3>Images Supplémentaires : </h3>
	<label for=''></label>
	<input type='file' id='' title='autres' name='imgs_<?=$id?>[]'  accept='image/png, image/gif, image/jpeg, image/avif, image/webp'  multiple='multiple'>
	<?php
	foreach($images as $image){
		echo("<a href='delete-img.php?img=$image'> <img src='$image' height='50'/> </a>");
	}
	?>
			
		<div>
			<h3>Description Courte : </h3>
			<input type='text' name='description_<?=$id?>' required='' value='<?=$description?>'>
		</div>
		<div>
			<h3>Contenue : </h3>
			<textarea name='content_<?=$id?>' rows='10' cols='90' required=''><?=$content?></textarea>
		</div>
		<input type='button' onclick='displayFormAddImg(<?=$id?>)' value="ajouter une images">
		
		<div>
			<h3>Prix : </h3>
			<input type='text' name='price_<?=$id?>' required='' value='<?=$price?>'>
		</div>
		<div>
			<h3>Personne maximum : </h3>
			<input type='number' name='personne_<?=$id?>' value='<?=$maximumPersonnes?>'>
		</div>
		<div>
			<h3>Nuitée minimum : </h3>
			<input type='number' name='night_<?=$id?>' value='<?=$minimumNight?>'>
		</div>
		<input type='submit' name='btn_<?=$id?>'>
	</form>
	<?php
	// if(intval($_SERVER['CONTENT_LENGTH'])>0 && count($_POST)===0){
	// 	throw new Exception('PHP discarded POST data because of request exceeding post_max_size.');
	// }
	if (isset($_POST['btn_'.$id])) { //si on appui sur le btn
		if (!empty($_POST['name_'.$id] && $_POST['content_'.$id] && $_POST['price_'.$id])) { // si les donner son pas vide
			uploadImgs('imgs_'.$id, $id);
			uploadImgs('carrousel_'.$id, $id, "car");
			uploadImg($_FILES["main_".$id]['tmp_name'], $id, 'main.'.getExtension($_FILES["main_".$id]['name']));

			// si le nom a changer on le change
			if($name != $_POST['name_'.$id]){
				$q = $db->prepare("UPDATE house SET name = :name WHERE name ='$name'");
				$q->execute(['name' => $_POST['name_'.$id]]);
				echo $_POST['name_'.$id];
			}
			updateSingle('house', $name,'name', 'name_'.$id, $name);
			updateSingle('house', $name,'visible', 'visible_'.$id, $visible);
			updateSingle('house', $name,'maximum_personnes', 'personne_'.$id, $maximumPersonnes);
			updateSingle('house', $name,'minimum_night', 'night_'.$id, $minimumNight);
			updateSingle('house', $name,'description', 'description_'.$id, $description);
			updateSingle('house', $name,'content', 'content_'.$id, $content);
			updateSingle('house', $name,'price', 'price_'.$id, $price);

			
			echo '<div class="success">Page modifié</div>';
		}else{
			echo '<div class="error">Veuillez remplir tous les champs!</div>';
		}
	}
} 
// var_dump($allImgsHouses);
?>
<script>
function closeFormAddImg(){
	var change = document.getElementById('image-adder');
	change.style.display = 'none';
	change.removeChild(document.getElementById('img-insertor'))
	var imgsSelector = document.getElementById('imgs-selector');
	imgsSelector.innerHTML = '';
}
function displayFormAddImg(number){
	var imgs = <?= json_encode($allImgsHouses)?>;
	console.log(imgs);
	// console.log(imgs);
	var change = document.getElementById('image-adder');
	change.style.display = 'block';
	
	var btn = document.createElement("button");
	btn.innerHTML = "Inserer";
	btn.id = 'img-insertor';
	btn.addEventListener('click', (e)=>{
		insertImg(number);
	});
	change.appendChild(btn);
	var imgsSelector = document.getElementById('imgs-selector');
	allFuturChilds = [];
	console.log(imgs[number]);
	for(const nb in imgs[number]){
		var imgPath = imgs[number][nb];
		// var imgPath = imgPath.slice(2, imgPath.length);
		console.log(imgPath);
		var input = document.createElement("input");
		var label = document.createElement("label");
		var img = document.createElement("img");
		img.src = imgPath;
		img.height = 50;
		img.witdh = 50;
		
		input.type = "radio";
		input.setAttribute('name', 'imgs-select');
		input.setAttribute('id', imgPath);
		label.setAttribute('for', imgPath);
		label.appendChild(img);
		allFuturChilds.push(label);
		allFuturChilds.push(input);
	}
	// var fs = require('fs');
	console.log('/images/'+number+'/');for (var i = 0; i < allFuturChilds.length; ++i) {
    	imgsSelector.appendChild(allFuturChilds[i]);
	}
	console.log(imgsSelector.children);
    // var files = glob('/images/'+number+'/'*.{jpg,png,gif}');
	// console.log(files);
}
function insertImg(number){
	var alter = document.getElementById('alter').value;
	var width = document.getElementById('width').value;
	var height = document.getElementById('height').value;
	var imgSelected = document.querySelector('input[name = "imgs-select"]:checked');
	if(alter == ""){console.log("alter vide") ;return;}
	if(height == "" && width == ""){console.log("dimension");return;}
	if(height == "" && width == ""){console.log("dimension");return;}
	if(imgSelected == null){console.log("no img");return;}
	var line = document.getElementById('line').checked;
	var style = document.getElementById('style').checked;
	var height = document.getElementById('height').value;
	var align = document.querySelector("input[name=align]:checked").id;
	var textarea = document.getElementsByName("content_2")[0];
	textarea.value += '<span '+(line? 'class="break-line"':'')+'><img alt="'+alter+'" '+(style?'class="img_hebergement" ':'') + (align!='center'?'style="float:'+align+';" ' :'')+'src="'+imgSelected.id.slice(1, imgSelected.id.length)+'" ' +(height ==''?'':'height="'+height+'px" ')+ (width == ''?'':'width="'+width+'px" ')+'/></span>';	

	
}
</script>
<div id='image-adder' style='display:none;' >
	<input type="button" value="Fermer" onclick="closeFormAddImg()">
	<div>
		<label for="alter">texte obligatoire * :</label>
		<input type="text" id='alter'>
	</div>
	<div>
		<label for="line">retour à la ligne</label>
		<input type="checkbox" id='line' checked>
		<label for="style">stylistique</label>
		<input type="checkbox" id='style' checked>
	</div>
	<div>
		<label for="left">gauche</label>
		<input type="radio" id='left' name='align' >
		<label for="center">centre/default</label>
		<input type="radio" id='center' name='align' checked>
		<label for="right">droite</label>
		<input type="radio" id='right' name='align' >
	</div>
	<fieldset>
		<label>Choix de l'image * :</label>
		<div id="imgs-selector">

		</div>
	</fieldset>
	<div>
		<label for="height">hauteur maximal</label>
		<input type="number" id='height' value='250'>
		<label for="width">largeur maximal</label>
		<input type="number" id='width' value='500'>
	</div>
	</div>
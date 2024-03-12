
<?php
function generateCarousselle(array $imgs){
    if (count($imgs)==0) return;
    $fristImg = $imgs[0];
    for( $i=0 ; $i < count($imgs) ; $i++ ) {
        $imgs[$i] = "\"".$imgs[$i]."\"";
        if ($i!=count($imgs)-1) $imgs[$i]= $imgs[$i].",";
    }
    $dots = "";
    for( $i=1 ; $i < count($imgs) ; $i++ ) $dots.= "<span class='dot' onclick='changeSlide(".$i.")'></span>";
echo "<script type='text/javascript'>
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
var slide = new Array(".implode($imgs).");

changeSlide(0);
slideRefresh();
</script>
<div
<div id='slider'>
<img id='slide' alt='slider d\'images' src='".$fristImg."' >
<div id='prev' onclick='mouveSlide(-1)'>❮</div>
<div id='next' onclick='mouveSlide(1)'>❯</div>
</div>
<div style='text-align: center;'>

<span class='dot active' onclick='changeSlide(0)'></span>".$dots."
</div>";
}
?>

<div class="alert-manager">
    
<?php
    
require_once 'database.php';

$allVisible = allVisible();
if(isset($_POST['assos_btn'])){
    if(!empty($_POST['pages']) && $_POST['pages'] != ''){
        $alert = null;
        if(!empty($_POST['alert']) && $_POST['alert'] != ''){
            $res = false;
            $isNull = false;
            if($_POST['alert'] ==='null'){
                $_POST['alert'] = null;
                // $isNull = true;
                // updateSingle('house', $visible['id'], 'alert', 'alert', 'id' );
            }
            // $alert = getAlert($_POST['alert']);  

            if($_POST['pages'] == 'locations' || $_POST['pages'] == 'all'){
                $res = true;
                foreach($allVisible as $visible){
                    updateSingle('house', $visible['id'], 'alert', 'alert', 'id' );
                }
                
            }
            if($_POST['pages'] == 'pages' || $_POST['pages'] == 'all'){
                $res = true;
                foreach(allPages() as $page){
                    updateSingle('page', $page['name'], 'alert', 'alert');
                }
            }else{
                foreach(allPages() as $page){
                    if($page['name'] === $_POST['pages']){
                        $res = true;
                        updateSingle('page', $page['name'], 'alert', 'alert');
                    }
                }
                if($res == false){
                    var_dump($_POST['pages']);
                    $house = getLocation(intval($_POST['pages']));
                    if($house != null){
                        $res = true;
                        updateSingle('house', $house->id, 'alert', 'alert', 'id' );
                    }
                }
                
            }
            if(!$res){?>
                <div class="error">Erreur lors de la recherche de page</div>
            <?php } else{ ?>
                <div class="success">Alert Associé</div>
            <?php }
        }else{ ?>
            <div class="error">champs alert mal selectioner</div>
        <?php }
    }else{ ?>
        <div class="error">champs page mal selectioner</div>
    <?php }
    
}
$allAlert = allAlert();
foreach($allAlert as $alert){
    if(isset($_POST['del_'.$alert['id']])){
        delAlert($alert['id']);
    }
    ?>
    <div>
        <form method="post">
            <label><?= htmlspecialchars($alert['content'])?></label>
            <input type="submit" value="Supprimer" name="del_<?= $alert['id']?>">
        </form>
    </div>
    <?php
}
if(isset($_POST['new']) && !empty($_POST['content'])){
    insAlert($_POST['content']);
}
function printSelect($value, $text){
    ?>
    <option value="<?= $value ?>"><?= $text ?></option>
    <?php
}
?>
<form method="post">
    <label for="content">contenue : </label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <input type="submit" value="Nouveau" name="new">
</form>

<form method="post">
    <!-- select pour une page -->
    <select name="pages">
        <?php
            printSelect('all', 'TOUS');
            printSelect('locations', 'TOUS HEBERGEMENTS');
            printSelect('pages', 'TOUTES PAGES');
            printSelect('', '--Hébergement--');
            foreach($allVisible as $page){
                var_dump($page);
                printSelect($page['id'], $page['name']);
            }
            printSelect('', '--pages--');
            foreach(allPages() as $page){
                printSelect($page['name'], $page['name']);
            }
            printSelect('', '--Hébergement désactivées--');
            foreach(array_diff(allLocation(), $allVisible) as $page){
                printSelect($page['name'], $page['name']);
            }
            ?>
    </select>
    <select name="alert">
        <?php
        printSelect('null', 'VIDE');
        foreach($allAlert as $alert){
            // var_dump(preg_replace('<.+>', '', substr($alert['content'],0 , 30).'...'));
            printSelect($alert['id'], substr(preg_replace('/<[^<>]+>/', '', htmlspecialchars($alert['content'])),0 , 30).'...');
        }
        ?>
    </select>   
    <input type="submit" value="Associer" name="assos_btn">
    <!-- select pour une alerte nullable -->
</form>
</div>
<!--  -->
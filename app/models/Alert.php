<?php

namespace App\Models;
use App\Models\IContentable;
use App\Table\Table;
include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'console/database.php';
include_once './IContentable.php';

class Alert{
    use IContentable;
    protected Table $table = new Table('alert');

    private function __construct(array $array = null)
    {
        if($array != null && Alert::isModelable($array)){
            $this->content = $array['content'];
            $this->pk = $array['id'];
        }
    }

    private static function isModelable(array $arr):bool{
        return isset($arr['content']) && isset($arr['id']);
    }
    public static function getAll(): array
    {
        echo'f';
        $res = [];
        foreach(Alert::getArrays() as $alertArray){
            array_push($res, new Alert($alertArray));
        }
        return $res;
    }
    public static function getSingle($PK): ?Alert
    {
        $single = Alert::getSingleArray($PK);
        return Alert::isModelable($single)?new Alert($single):null;
    }

    public static function save($model): bool
    {
        global $db;
        if($model->pk == null){
            $res = $db->query("INSERT INTO ".Alert::TABLE."(content) VALUES('".$model->getContent()."')");
            $model->pk = Alert::getArrays('*','WHERE content='.$model->getContent())[0]['id'];
            return $res;
        }
        return false;
    }
    public static function delete($model):bool
    {
        global $db;
        if($model->pk == null) return false;
        return $db->query("DELETE FROM ".Alert::TABLE."WHERE ".$model::PK."=".$model->pk);
        
    }
}
echo'c';

var_dump(Alert::getAll());

?>
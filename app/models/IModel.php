<?php

namespace App\Models;

use \App\Table\Table;

trait IModel{
    protected $pk = null;
    protected $table = new Table('alert');
    

    public function getPk(){
        return $this->pk;
    }
    abstract public static function getAll():array;
    abstract public static function getSingle($PK);
    
    /**
     * @param T $model
     */
    abstract public static function save($model):bool;
    /**
     * @param T $model
     */
    abstract public static function delete($model):bool;

    abstract private static function isModelable(array $arr):bool;
}
?>
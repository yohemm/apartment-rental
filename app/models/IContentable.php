<?php

namespace App\Models;

include_once './IModel.php';

trait IContentable{
    use IModel;
    private string $content;
    public function getContent():string{
        return $this->content;
    }
    public function setContent(string $content):bool{
        $this->content = $content;
        return true;
    }
}
?>
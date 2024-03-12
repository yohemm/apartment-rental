<?php

namespace App\Models;
trait IPage{
    private string $title;
    private string $subTitle;
    private string $articleId;

    use App\Models\IContentable;
    public function getTitle():string{
        return $this->title;
    }
    public function setTitle(string $title):bool{
        $this->title =$title;
        return true;
    }
    public function getSubTitle():string{
        return $this->subTitle;
    }
    public function setSubTitle(string $subTitle):bool{
        $this->subTitle =$subTitle;
        return true;
    }
}

?>
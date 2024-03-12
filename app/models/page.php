<?php


namespace App\Models;
class Page
{
    use IPage;
    protected static string $TABLE='page';


    private function __construct(array $array)
    {
        $this->content = $array['content'];
        $this->title = $array['title'];
        $this->subTitle = $array['title'];
    }



    public static function getAll(): array
    {
        $res = [];
        Page::getArrays();
        return $res;
    }
    public static function getSingle($PK): ?Page
    {
        return null;
    }
    public static function save(Page $model): bool
    {
        return false;
    }
    public static function delete(Page $model)
    {
    }
}

<?php

namespace App\Models;
trait IAccount{
    use IModel;

    private string $pseudo;
    private string $hashpass;
    abstract private static function hashStr(string $toHash):string;
    public function getPseudo():string{
        return $this->pseudo ;
    }
    public function setPseudo(string $pseudo):bool{
        $this->pseudo = $pseudo;
        return true;
    }
    public function getPassword():string{
        return $this->hashpass ;
    }
    public function setPassword(string $passNotHash):bool{
        $this->hashpass = IAccount::hashStr($passNotHash);
        return true;
    }
}
?>
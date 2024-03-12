<?php
namespace App\Table;
use PDO;
use App\Database;
abstract Class Table{
    protected string $table;
    protected string $pkColum = 'id';
    
    public function all(string $ending = ''):array{
        return Database::getDb()->query("SELECT * FROM ".$this->table . " ". $ending . ";--")->fetchAll();
    }
    public function getSingle(string $id):array{
        return $this->all("WHERE ".$this->pkColum ." = ".$id)[0];
    }

    public function delete(string $pk):bool{
        $req = Database::getDb()->prepare("DELETE FROM ".$this->table . " WHERE ". $this->pkColum . " = :pk;--");
        return $req->execute(['pk'=>$pk]);
    }

    protected function insertQuery():string{
        return "INSERT INTO ".$this->table;
    }
    protected function updateQuery():string{
        return "UPDATE $this->table SET ";
    }
}
include_once $_SERVER['CONTEXT_DOCUMENT_ROOT'].'console/database.php';
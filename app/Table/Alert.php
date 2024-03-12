<?php
namespace App\Table;
use \App\Database;
var_dump(Database::getDb());
use \App\Table\Table;


Class Alert extends Table{
    
    protected string $table ='alert';
    public function insert(string $content): bool{
        $query = Database::getDb()->prepare($this->insertQuery() + "(content) VALUES(?)");
        return $query->execute([$content]);
    }
    public function update(string $id, string $content): bool{
        $query = Database::getDb()->prepare($this->updateQuery() + " content=? WHERE $this->pkColum = ?");
        return $query->execute([$content, $id]);
    }
}
?>
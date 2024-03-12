<?php
namespace App;

use PDO;

Class Database{

    const SQL_LANGUAGE = 'pgsql';
    const HOST = 'localhost';
    const DB_NAME = 'appart';
    const USER = 'postgres';
    const PASS = '123456789';

    public static function getDb(){
        echo 'a';
        try {
            $db = new PDO(Database::SQL_LANGUAGE.':host='.Database::HOST. ';port=5432;dbname='. Database::DB_NAME, Database::USER, Database::PASS);
            echo 'b';
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo '';
            return $db;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
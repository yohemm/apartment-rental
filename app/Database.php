<?php
namespace App;

use PDO;

Class Database{

    const SQL_LANGUAGE = 'pgsql';
    const HOST = '2a01:cb11:5f8:e700:383d:4d41:ec61:6787';
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
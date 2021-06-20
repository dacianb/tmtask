<?php

namespace App\Db;

use App\Db\Postgres;
use App\Lib\Settings;

/** 
 * Basic DB Migration class
 * @package App\Db 
 * */
class Migrations {
    
    private $conn;

    public function __construct()
    {
        $host = Settings::get("host");
        $port = Settings::get("port");
        $db = Settings::get("db");
        $user = Settings::get("user");
        $password = Settings::get("password");

        $this->conn = Postgres::get()->connect($host, $port, $db, $user, $password);
    }

    /** @return void  */
    public function migrate(): void{
        $this->createAuthorsTable();
        $this->createBooksTable();
    }

    //TODO Create table drop methrods
    public function drop(){

    }

    private function createAuthorsTable(){
        $sql = "CREATE TABLE IF NOT EXISTS authors (id serial PRIMARY KEY, name VARCHAR ( 128 ) UNIQUE NOT NULL);";
        $stmt = $this->conn->query($sql);
    }

    private function createBooksTable(){
        $sql = "CREATE TABLE IF NOT EXISTS books (id serial PRIMARY KEY, author_id INT, name VARCHAR ( 128 ), CONSTRAINT fk_author FOREIGN KEY(author_id) REFERENCES authors(id) ON DELETE CASCADE);";
        $stmt = $this->conn->query($sql);
    }
}
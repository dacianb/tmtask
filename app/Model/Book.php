<?php

namespace App\Model;


/** 
 * Book model class
 * @package App\Model */
class Book extends Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = "books";
    }

    public function create(int $authorId, string $name){

        $this->executeStatement("INSERT INTO $this->table (author_id, name) VALUES(:authorId, :name)", ["authorId" => $authorId, "name" => $name]);

        return $this->id = $this->conn->lastInsertId();
    }

    public function find(int $authorId, string $name): bool{
        $stmt = $this->executeStatement("SELECT * FROM $this->table WHERE author_id = :authorId AND name LIKE :name LIMIT 1", ["authorId" => $authorId, "name" => $name]);

        $book = $stmt->fetch();
        
        if(!isset($book['id'])){
            return false;
        }

        $this->id = $book['id'];
        return true;    
    }

    public function findOrCreate(int $authorId, string $name){
        if(!$this->find($authorId, $name)){
            return $this->create($authorId, $name);
        }
        return $this->id;
    }

}
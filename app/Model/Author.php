<?php

namespace App\Model;

use App\Model\Model;
use Exception;

/** 
 * Author model class
 * @package App\Model */
class Author extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "authors";
    }


    /**
     * @param string $name 
     * @return int 
     */
    public function create(string $name): int
    {
        $this->executeStatement("INSERT INTO $this->table (name ) VALUES (:name)", ["name" => $name]);

        return $this->id = $this->conn->lastInsertId();
    }

    /**
     * @param string $name 
     * @return int 
     */
    public function findOrCreate(string $name): int
    {
        if (!$this->find($name)) {
            return $this->create($name);
        }
        return $this->id;
    }


    /**
     * @param string $name 
     * @return bool  
     */
    public function find(string $name): bool
    {
        $stmt = $this->executeStatement("SELECT * FROM $this->table WHERE LOWER(name) LIKE LOWER(:name) LIMIT 1", ["name" => $name]);

        $author = $stmt->fetch();

        if (!isset($author["id"])) {
            return false;
        }

        $this->id = $author["id"];
        return true;
    }

    /**
     * //TODO: This is not supposed to be here!
     * @return array 
     * @throws Exception 
     */
    public function getAuthorBooks(): array
    {
        $result = [];

        if (!isset($this->id)) {
            throw new Exception("Author was not initialized");
        }

        $stmt = $this->executeStatement("SELECT authors.name AS author_name, books.name AS book_name FROM $this->table LEFT OUTER JOIN books ON authors.id = books.author_id WHERE authors.id = :authorId", ["authorId" => $this->id]);

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    //TODO: This is not supposed to be here!
    public function getAllBooks(): array
    {
        $result = [];

        $stmt = $this->executeStatement("SELECT authors.name AS author_name, books.name AS book_name FROM $this->table LEFT OUTER JOIN books ON authors.id = books.author_id", []);

        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }
}

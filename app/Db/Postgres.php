<?php

namespace App\Db;

use PDO;
use PDOException;

/** 
 * Singleton DB conection class
 * @package App\Db 
*/
class Postgres
{

    private static $conn;

    /**
     * @param string $host 
     * @param int $port 
     * @param string $db 
     * @param string $user 
     * @param string $password 
     * @return PDO 
     */
    public static function connect(string $host, int $port, string $db, string $user, string $password): PDO
    {

        $connString = sprintf(
            "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $host,
            $port,
            $db,
            $user,
            $password
        );

        try {
            $pdo = new PDO($connString);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function get()
    {
        if (static::$conn === null) {
            static::$conn = new static();
        }

        return static::$conn;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}

<?php

namespace App\Model;

use Exception;
use App\Db\Postgres;
use App\Lib\Settings;


/**
 * Abstract class used by all the model classes
 * TODO: Abstract some of the common methods used by the child classes! 
 * @package App\Model 
 */
abstract class Model
{

    protected $conn;
    protected $table;
    public int $id;

    public function __construct()
    { 
        $host = Settings::get("host");
        $port = Settings::get("port");
        $db = Settings::get("db");
        $user = Settings::get("user");
        $password = Settings::get("password");

        $this->conn = Postgres::get()->connect($host, $port, $db, $user, $password);

    }

    /**
     * @param string $statement 
     * @param array $parameters 
     * @return mixed 
     * @throws Exception 
     */
    protected function executeStatement( string $statement = "" , array $parameters = [] ){
        try{
            
            $stmt = $this->conn->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }

}

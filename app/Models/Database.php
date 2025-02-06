<?php

namespace app\Models;

use PDO;
use PDOException;

class Database
{

    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $config = require __DIR__ . '/app/Config/config.php';
        $db = $config['database'];

        try {
            $this->connection = new PDO(
                "{$db['driver']}:host={$db['host']};dbname={$db['dbname']}",
                $db['user'],
                $db['password']
            );

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Connection failed: " . $e->getMessage());
        }
    }


    public static function getInstance()
    {
        if (self::$instance === null){
            self :: $instance = new self();
        }

        return self :: $instance ;
    }

    public function getConnection()
    {
        return $this -> connection;
    }
}

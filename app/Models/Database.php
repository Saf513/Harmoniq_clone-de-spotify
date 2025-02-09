<?php

namespace app\Models;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;
    private $user = 'postgres';
    private $password = '123456';
    private $dbname = 'spotify';
    private $host = 'localhost';
    private $port = 5432;

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "pgsql:host=localhost;port=5432;dbname=spotify",
                    'postgres',
                    '123456'
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new PDOException('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }

    private function __clone() {}
}
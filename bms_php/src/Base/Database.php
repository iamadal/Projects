<?php
namespace Components\Base;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private function __construct() {}

    public static function init() {
        if (self::$instance === null) {
            // Assuming the SQLite database path is defined in the config file.
            $config = parse_ini_file(__DIR__ . '/../Database/db.ini', true); 
            $dbConfig = $config['database'];

            try {
           
                self::$instance = new PDO(
                    'sqlite:' . __DIR__ . '/../Database/' . $dbConfig['database']  
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

<?php

//namespace global;
require_once "config.php";

namespace database;

class Database {
    private static $instance = null;
    private $pdo;

    private final function __construct() {
        $host = DB_HOST;
        $db = DB_NAME;
        $username = DB_USER;
        $password = DB_PASS;


        try {
            $this->pdo = new \PDO("mysql:host=$host;dbname=$db", $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            echo "Connected successfully";
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Singleton principle: only one connection is active.
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance->pdo;
    }
}


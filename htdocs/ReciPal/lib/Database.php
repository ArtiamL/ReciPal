<?php
namespace lib;

require_once "config.php";

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
            syslog(LOG_INFO,"Connected successfully");
        } catch (\PDOException $e) {
            syslog(LOG_ALERT, "Connection failed: " . $e->getMessage());
        }
    }

    // Singleton principle: only one connection is active.
    public static function getInstance(): \PDO {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance->pdo;
    }
}


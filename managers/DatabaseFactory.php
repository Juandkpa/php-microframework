<?php


class DatabaseFactory {

    private static $factory;
    private $db;
    const DB_TYPE = 'mysql';
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'fon_test';
    const DB_PORT = '3306';
    const DB_CHARSET = 'utf8';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    

    public static function getFactory() {
        if(!self::$factory) {
            echo " \n calling new databaseFactory";
            self::$factory = new DatabaseFactory();
        }
        return self::$factory;
    }

    public function getConnection() {
        echo "\n haaa esta aqui";
        if(!$this->db) {
            try {
                $options = [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                ];
                echo "\n";
                echo self::buildPdoConfig();
                //die(); 
                $this->db = new PDO(
                    self::buildPdoConfig(),
                    self::DB_USER,
                    self::DB_PASSWORD
                );
            }catch(PDOException $e) {
                echo '\n Error de conexión a la base de datos.' . '<br>';
                echo 'Error code: ' . $e->getCode();
                echo '\n Error message:' . $e->getMessage();
                exit;
            }
        }
        return $this->db;
    }

    private static function buildPdoConfig() {
        return ""
            . self::DB_TYPE
            . ":host="   .  self::DB_HOST
            . ";dbname=" . self::DB_NAME
            . ";port="   . self::DB_PORT
            . ";charset=". self::DB_CHARSET;
    }

}

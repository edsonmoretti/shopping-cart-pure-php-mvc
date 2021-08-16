<?php


namespace App\Database;


use PDO;

class Conn
{
    private static PDO $instance;

    private function __construct()
    {
    }

    /**
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '',
                DB_USER,
                DB_PASSWORD);
        }
        return self::$instance;
    }

}
<?php

abstract class Connection
{
    private static $conn;

    public static function getConn()
    {
        if (!isset(self::$conn)) {
            self::$conn = new PDO("mysql: host=127.0.0.1:3306; dbname=crudmvc", "root", "");
        }
        return self::$conn;
    }
}
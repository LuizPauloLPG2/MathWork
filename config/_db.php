<?php

class Db
{

    protected static $connect = null;

    public static function init()
    {
        try {
            if (self::$connect == null) {
                self::$connect = new PDO(
                    "mysql:host=localhost;dbname=mathwork;",
                    "root",
                    "",
                    array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    )
                );
            }

            return self::$connect;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

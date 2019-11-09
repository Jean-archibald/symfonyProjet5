<?php
namespace MyFram;

class PDOFactory
{
    public static function getMysqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=symfonyProjet5', 'root', 'root');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}
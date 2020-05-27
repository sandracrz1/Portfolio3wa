<?php

Class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "fastfood_code";
    private static $dbUser = "root";
    private static $dsUserPassWord = "";
    private static $connection = null;
    
    public static function connect()
    {
        try
        {
            self::$connection = new PDO("mysql:host=". self::$dbHost .";dbname=". self:: $dbName,self::$dbUser,self::$dsUserPassWord);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
        return  self::$connection;
    }
   
    public static function disconnect()
    {
        self::$connection = null;
    }
}

?>
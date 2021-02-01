<?php

if(file_exists("../db_config.php"))
	require_once "../db_config.php";
else require_once "db_config.php";
class Database
{
   

    private static $dbHost = HOSTNAME;
    private static $dbName = DB_NAME;
    private static $dbUsername = USERNAME;
    private static $dbUserpassword = PASSWORD;
    private $db;
    
    private static $connection = null;
    
    public static function connect()
    {
        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUsername, self::$dbUserpassword,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }

    public function query($sql){

        $req = self::$connection->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    
    public static function disconnect()
    {
        self::$connection = null;
    }

}
?>
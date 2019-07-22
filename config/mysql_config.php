<?php 

namespace Mysql;

use Mysqli; // for mysqli


class DB
{
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    private const DB_SERVER = 'localhost';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';
    private const DB_NAME = 'testing';

    public static function connect()
    {
        echo "Connecting to database ...";
        $mysqli = new mysqli(
            self::DB_SERVER, 
            self::DB_USERNAME, 
            self::DB_PASSWORD, 
            self::DB_NAME
        );
        $mysqli -> set_charset('utf8mb4');

        if ($mysqli -> connect_errno)
            echo "Failed to connect to MySQL: (".$mysqli->connect_errno.")";

        echo "Successfully connected.";
        return $mysqli;
    }

    public static function close($connection)
    {
        try
        {
            echo "Closing database connection ...";
            $connection -> close();
            echo "Successfully closed.";
            return True;
        } catch(Exception $e)
        {
            echo "Error closing database!";
            echo "\n".$e;
            return False;
        }
    }
}   


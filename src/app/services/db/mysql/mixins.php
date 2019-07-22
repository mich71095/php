<?php

require_once "C:/wamp64/www/php/config/mysql_config.php";
use Mysql\DB as mysql_connection;

function isNewUsername($username)
    {
        $conn = mysql_connection::connect(); 
        $prepare = "SELECT * FROM users WHERE username = ?";

        if (!($stmt = $conn -> prepare($prepare)))
        {
            echo "Prepare failed: (" . $conn->errno . ") ".$conn->error;
            return False;
        }

         if (!($stmt -> bind_param("s", $username)))
        {
            echo "Binding parameters failed: (" . $stmt->errno . ") ".$stmt->error;
            return False;
        }

        if (!($stmt -> execute()))
        {
            echo "Execute failed: (" . $stmt->errno . ") ".$stmt->error;
            return False;
        }

        if (($arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)))
            return False;

        if (!($stmt -> close()))
        {
            echo "Closing failed: (" . $stmt->errno . ") ".$stmt->error;
            return False;
        }

        mysql_connection::close($conn);
        return True;
    }
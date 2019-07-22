<?php 

require_once "C:/wamp64/www/php/config/mysql_config.php";
use Mysql\DB as mysql_connection;

function saveToDB($username, $password)
{
    echo "Saving to database ...";
    $password = hash('sha512', $password);
    $conn = mysql_connection::connect(); 
    $prepare = "INSERT INTO users (".USERNAME.", ".PASSWORD.") VALUES (?, ?)";
    
    if (!($stmt = $conn -> prepare($prepare)))
    {
        echo "Prepare failed: (" . $conn->errno . ") ".$conn->error;
        return False;
    }

    if (!($stmt -> bind_param("ss", $username, $password)))
    {
        echo "Binding parameters failed: (" . $stmt->errno . ") ".$stmt->error;
        return False;
    }

    if (!($stmt -> execute()))
    {
        echo "Execute failed: (" . $stmt->errno . ") ".$stmt->error;
        return False;
    }

    if (!($stmt -> close()))
    {
        echo "Closing failed: (" . $stmt->errno . ") ".$stmt->error;
        return False;
    }

    mysql_connection::close($conn);
    echo "Successfully saved to database.";
    return True;
    
}
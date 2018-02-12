<?php

require ("../config/database.php");

/**
 * Description of connectionHelper
 *
 * @author Empar Ibáñez
 */
class connectionHelper {

    private $mysqli;

    function checkConnection() {
        $connection = new mysqli($hostname, $username, $password, $dbname);
        if ($connection->connect_errno) {
            return false;
        } else {
            $this->mysqli = $connection;
            return true;
        }
    }
    
    public function getConnection() {
        return $this->mysqli;
    }

}

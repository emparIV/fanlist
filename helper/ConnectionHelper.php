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
        $connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($connection->connect_errno) {
            return false;
        } else {
            $this->mysqli = $connection;
            return true;
        }
    }
    
    public function getConnection() {
       return $connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

}

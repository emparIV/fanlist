<?php


/**
 * Description of connectionHelper
 *
 * @author Empar Ibáñez
 */
class ConnectionHelper {
    

    private $mysqli;

    public function checkConnection() {
        $connection = new mysqli("127.0.0.1", "root", "bitnami", "fanlist");
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

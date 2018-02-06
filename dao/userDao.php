<?php

require '../helper/connection.php';
require '../bean/userBean.php';

/**
 * Description of userDao
 *
 * @author a053881694p
 */
class userDao implements DaoTableInterface, DaoViewInterface {
    
    public function construct($conexion) {
        $this->conexion = $conexion;
    }

    public function get($bean) {
        if ($this->conexion) {
            try {
                $resultSet = NULL;
                $preparedStatement = $mysqli->prepare("SELECT * FROM ? WHERE 1=1 AND id= ?");
                $preparedStatement->bind_param('si', "user", $bean->id);
                $preparedStatement->execute();
                $preparedStatement->store_result();
                if ($preparedStatement->num_rows > 0) {
                    $resultSet = mysqli_fetch_array($preparedStatement, MYSQLI_ASSOC);
                    $bean = $bean->construct($resultSet);
                } else {
                    throw new Exception();
                }
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            } finally {
                if ($preparedStatement !== NULL) {
                    $preparedStatement->close();
                }
            }
        } else {
            throw new Exception();
        }
        return $bean;
    }

    public function set($bean) {
        
    }

    public function remove($bean) {
        
    }

    public function login() {

        $user = $_GET['user'];
        $hashedPassword = hash('sha256', $_GET['pass']);

        $preparedStatement = $mysqli->prepare("SELECT * FROM user WHERE username LIKE ? AND password LIKE ? ");
        $preparedStatement->bind_param('ss', $user, $hashedPassword);
        $preparedStatement->execute();
        $preparedStatement->store_result();

        $resultSet = array();

        if ($preparedStatement->num_rows > 0) {

            while ($row = mysqli_fetch_array($preparedStatement, MYSQLI_ASSOC)) {
                $resultSet[] = $row;

                // Crea un userBean a partir de la fila devuelta
                new userBean($row['id'], $row['name'], $row['mail'], $row['username'], $row['password'], $row['url'], $row['profile_pic'], $row['custom_field1'], $row['custom_field2'], $row['custom_field3'], $row['custom_field4'], $row['custom_field5']);
            }

            header("Content-Type: application/json", true);
            $json = json_encode("\"status\": 200", $resultSet);
        } else {
            header("Content-Type: application/json", true);
            $json = json_encode("\"status\": 401", $resultSet);
        }

        return json;
    }

    public function getCount($bean) {
        
    }

    public function getPage($bean) {
        
    }

}

<?php

/**
 * Description of userDao
 *
 * @author Empar Ibáñez
 */
class UserDao implements DaoTableInterface, DaoViewInterface {

    public function construct() {
        
    }

    public function get($id) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $sql = $connection->getConnection();
                $aTest = NULL;
                $preparedStatement = $mysqli->prepare("SELECT * FROM ? WHERE 1=1 AND id= ?");
                $preparedStatement->bind_param('si', "user", $id);
                $preparedStatement->execute();
                $preparedStatement->store_result();
                $rows = $preparedStatement->num_rows;
                if ($rows > 0) {
                    $meta = $preparedStatement->result_metadata();
                    while ($field = $meta->fetch_field()) {
                        $params[] = &$row[$field->name];
                    }
                    call_user_func_array(array($preparedStatement, 'bind_result'), $params);
                    while ($preparedStatement->fetch()) {
                        foreach ($row as $key => $val) {
                            $c[$key] = $val;
                        }
                        $aTest = $c;
                    }

                    $aResponse = $aTest;
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
        return $aResponse;
    }

    public function set($bean) {
     if ($this->conexion) {
            $iResult = 0;
            try {
                $insert = TRUE;
                if ($bean->id == NULL) {
                    $preparedStatement = $mysqli->prepare("INSERT INTO ?"
                            . "(name, mail, username, password, url, profile_pic, custom_field1, "
                            . "custom_field2, custom_field3, custom_field4, custom_field5) VALUES( "
                            ."?,?,?,?,?,?,?,?,?,?,?,)");
                    $preparedStatement->bind_param('ssssssssssss', "user", $bean->name, 
                            $bean->mail, $bean->username, $bean->password, $bean->url, 
                            $bean->profile_pic, $bean->custom_field1, $bean->custom_field2, 
                            $bean->custom_field3, $bean->custom_field4, $bean->custom_field5);
                    $preparedStatement->execute();
                    $preparedStatement->store_result();                    
                } else {
                    $insert = FALSE;
                    $preparedStatement = $mysqli->prepare("UPDATE ? SET "
                            . "name = ?, mail = ?, username = ?, password = ?, url = ?, profile_pic = ?, "
                            . "custom_field1 = ?, custom_field2 = ?, custom_field3 = ?, custom_field4 =?,"
                            . " custom_field5 WHERE id = ? ");
                    $preparedStatement->bind_param('ssssssssssssi', "user", $bean->name, 
                            $bean->mail, $bean->username, $bean->password, $bean->url, 
                            $bean->profile_pic, $bean->custom_field1, $bean->custom_field2, 
                            $bean->custom_field3, $bean->custom_field4, $bean->custom_field5, $bean->id);
                    $preparedStatement->execute();
                    $preparedStatement->store_result();
    }
                if ($preparedStatement->num_rows < 0) {                    
                    throw new Exception();
                }
                if ($insert) {
                    $iResult = $mysqli->insert_id;
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
        return $iResult;
    }

    public function remove($bean) {
        
    }

    public function getFromLoginAndPass($array) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $sql = $connection->getConnection();
                $aTest = NULL;
                $preparedStatement = $sql->prepare("SELECT * FROM user WHERE 1=1 AND username = ? AND password = ?");
                $preparedStatement->bind_param('ss', $array['username'], $array['password']);
                $preparedStatement->execute();
                $preparedStatement->store_result();
                $rows = $preparedStatement->num_rows;
                if ($rows > 0) {
                    $meta = $preparedStatement->result_metadata();
                    while ($field = $meta->fetch_field()) {
                        $params[] = &$row[$field->name];
                    }
                    call_user_func_array(array($preparedStatement, 'bind_result'), $params);
                    while ($preparedStatement->fetch()) {
                        foreach ($row as $key => $val) {
                            $c[$key] = $val;
                        }
                        $aTest = $c;
                    }

                    $aResponse = $aTest;
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
        return $aResponse;
    }

    public function getCount($alFilter) {
        if ($this->conexion) {
            $query = "SELECT COUNT(*) FROM ? WHERE 1=1 ";
            $query += $SqlHelper->buildSqlFilter($alFilter);
            try {
                $resultSet = NULL;
                $preparedStatement = $mysqli->prepare($query);
                $preparedStatement->bind_param('s', "user");
                $preparedStatement->execute();
                $preparedStatement->store_result();
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
        return $iResult;
    }

    public function getPage($regsPerPage, $page, $alOrder, $alFilter) {
        
    }

}

<?php

/**
 * Description of newsDao
 *
 * @author Empar Ibáñez
 */
class NewsDao implements DaoTableInterface, DaoViewInterface {

    public function construct() {
        
    }

    public function get($id) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $sql = $connection->getConnection();
                $aTest = NULL;
                $preparedStatement = $sql->prepare("SELECT n.id, n.title, n.content, n.date, u.name FROM news n, user u WHERE n.user_id = u.id AND n.id = ?");
                $preparedStatement->bind_param('s', $id);
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

    public function set($array) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            $response = NULL;
            $iResult = 0;
            try {
                $insert = TRUE;
                if ($array['id'] == "") {
                    $sql = $connection->getConnection();
                    $preparedStatement = $sql->prepare("INSERT INTO news "
                            . "(title, content, date, user_id) VALUES( "
                            . "?,?,NOW(),?)");
                    $preparedStatement->bind_param('ssi', $array['title'], $array['content'], $array['user_id'] );
                    $preparedStatement->execute();
                    $preparedStatement->store_result();
                    $preparedStatement->bind_result($response);
                    $preparedStatement->fetch();
                    
                } else {
                    $insert = FALSE;
                    $sql = $connection->getConnection();
                    $preparedStatement = $sql->prepare("UPDATE news SET "
                            . "title = ?, content = ? WHERE id = ? ");
                    $preparedStatement->bind_param('ssi', $array['title'], $array['content'], $array["id"]);
                    $preparedStatement->execute();
                    $preparedStatement->store_result();
                    $preparedStatement->bind_result($response);
                    $preparedStatement->fetch();
                }
                if ($preparedStatement->num_rows < 0) {
                    throw new Exception();
                }
                if ($insert) {
                    $iResult = $sql->insert_id;
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
        return $response;
    }

    public function remove($id) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $aResponse = NULL;
                $sql = $connection->getConnection();
                $preparedStatement = $sql->prepare("DELETE FROM news WHERE 1=1 AND id = ?");
                $preparedStatement->bind_param('s', $id);
                $preparedStatement->execute();
                $preparedStatement->store_result();
                $preparedStatement->bind_result($aResponse);
                $preparedStatement->fetch();
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

    public function getCount() {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $aResponse = NULL;
                $sql = $connection->getConnection();
                $preparedStatement = $sql->prepare("SELECT COUNT(*) FROM news WHERE 1= ? ");
                $preparedStatement->bind_param('i', $a = 1);
                $preparedStatement->execute();
                $preparedStatement->store_result();
                $preparedStatement->bind_result($aResponse);
                $preparedStatement->fetch();
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

    public function getPage($np, $rpp) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $oSqlHelper = new SqlHelper;
                $total = $this->getCount();
                $query = "SELECT n.id, n.title, n.content, n.date, u.name FROM news n, user u WHERE 1=1 AND n.user_id = u.id AND 1 = ? ";
                $query .= $oSqlHelper->buildSqlLimit($total, $np, $rpp);
                $sql = $connection->getConnection();
                $aTest = NULL;
                $aResponse = array();
                $preparedStatement = $sql->prepare($query);
                $preparedStatement->bind_param('i', $a = 1);
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
                        array_push($aResponse, $aTest);
                    }
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

}

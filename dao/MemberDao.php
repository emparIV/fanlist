<?php

/**
 * Description of MemberDao
 *
 * @author Empar Ibáñez
 */
class MemberDao implements DaoTableInterface, DaoViewInterface {

    public function construct() {
        
    }

    public function getFromLoginAndPass($array) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $sql = $connection->getConnection();
                $aTest = NULL;
                $preparedStatement = $sql->prepare("SELECT * FROM member WHERE 1=1 AND username = ? AND password = ?");
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

    public function get($id) {
        $connection = new ConnectionHelper();
        if ($connection->checkConnection()) {
            try {
                $sql = $connection->getConnection();
                $aTest = NULL;
                $preparedStatement = $sql->prepare("SELECT * FROM member WHERE 1=1 AND id = ?");
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
                    $preparedStatement = $sql->prepare("INSERT INTO member "
                            . "(username, password, name, mail, country, gender, twitter_url, facebook_url,"
                            . " instagram_url, url, show_mail, comment, profile_pic, add_date, custom_field1, "
                            . "custom_field2, custom_field3, custom_field4, custom_field5) VALUES( "
                            . "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $preparedStatement->bind_param('sssssssssssssssssss', $array['username'], $array['password'], 
                            $array['name'], $array['mail'], $array['country'], $array['gender'], $array['twitter_url'], 
                            $array['facebook_url'], $array['instagram_url'], $array['url'], $array['show_mail'],
                            $array['comment'], $array['profile_pic'], $array['add_date'], $array['custom_field1'], 
                            $array['custom_field2'], $array['custom_field3'], $array['custom_field4'], $array['custom_field5']);
                    $preparedStatement->execute();
                    $preparedStatement->store_result();
                    $preparedStatement->bind_result($response);
                    $preparedStatement->fetch();
                } else {
                    $insert = FALSE;
                    $sql = $connection->getConnection();
                    $preparedStatement = $sql->prepare("UPDATE member SET "
                            . "username = ?, password = ?, name = ?, mail = ?, country = ?, gender = ?, twitter_url = ?, "
                            . "facebook_url = ?, instagram_url = ?, url = ?, show_mail = ?, comment = ?, profile_pic = ?, "
                            . "add_date = ?, custom_field1 = ?, custom_field2 = ?, custom_field3 = ?, custom_field4 = ?, "
                            . "custom_field5 = ? WHERE id = ? ");
                    $preparedStatement->bind_param('sssssssssssssssssssi', $array['username'], $array['password'], 
                            $array['name'], $array['mail'], $array['country'], $array['gender'], $array['twitter_url'], 
                            $array['facebook_url'], $array['instagram_url'], $array['url'], $array['show_mail'],
                            $array['comment'], $array['profile_pic'], $array['add_date'], $array['custom_field1'], 
                            $array['custom_field2'], $array['custom_field3'], $array['custom_field4'], $array['custom_field5'], $array['id']);
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
                $preparedStatement = $sql->prepare("DELETE FROM member WHERE 1=1 AND id = ?");
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
                $preparedStatement = $sql->prepare("SELECT COUNT(*) FROM member WHERE 1= ? ");
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
                $query = "SELECT * FROM member WHERE 1 = ? ";
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

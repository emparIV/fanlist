<?php

require '../bean/userBean.php';
require '../dao/UserDao.php';
require 'ServiceTableInterface.php';
require 'ServiceViewInterface.php';

/**
 * Description of userService
 *
 * @author Empar Ibáñez
 */
class userService implements ServiceTableInterface, ServiceViewInterface {
    
    private function checkPermission($metodo) {
        $userSession = $_SESSION['user'];
        if (isset($userSession)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function login($json) {
        $oBean = new UserBean();
        $oBean->construct($json);
        if (!($oBean->getUsername()) == "" && !($oBean->getPassword()) == "") {
            try {
                $oDao = new UserDao();
                $oResult = $oDao->getFromLoginAndPass($oBean);
                session_start();
                $_SESSION['user'] = $oResult;
                $aResult = [200, $oResult];
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            }
            return new ReplyBean($aResult);
        } else {
            $aResult = [401, "Unauthorized operation"];
            return new ReplyBean($aResult);
        }
    }
    
    public function logout() {
        if ($this->checkPermission("logout")) {
            session_destroy();
            $aResult = [200, "Session is closed"];
            return new ReplyBean($aResult);
        } else {
            throw new Exception();
        }
    }

    public function get() {
        if ($this->checkPermission("get")) {
            $id = $json['id'];
            $connection = new ConnectionHelper();
            try {
                $oBean = new UserBean();
                $oBean->setId($id);
                $oDao = new UserDao($connection->getConnection());
                $oBean = $oDao->get($oBean);
                $toJson = json_encode($oBean);
                $oReplyBean = new ReplyBean(200, $toJson);
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            }
            return $oReplyBean;
        } else {
            return new ReplyBean(401, "Unauthorized operation");
        }
    }

    public function getCount() {
        
    }

    public function getPage() {
        
    }

    public function remove() {
        
    }

    public function set() {
        
    }

}

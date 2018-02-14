<?php



/**
 * Description of userService
 *
 * @author Empar Ibáñez
 */
class UserService implements ServiceTableInterface, ServiceViewInterface {
    
    private function checkPermission() {
        if (isset($_SESSION['user'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function login($json) {
        if (!($json['username']) == "" && !($json['password']) == "") {
            try {
                $oDao = new UserDao();
                $oResult = $oDao->getFromLoginAndPass($json);
                session_start();
                $_SESSION['user'] = $oResult;
                $aResult = ["status" => 200, "json" => $oResult];
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            }
            return $aResult;
        } else {
            $aResult = ["status" => 401, "json" => "Unauthorized operation"];
            return $aResult;
        }
    }
    
    public function logout() {
        if ($this->checkPermission()) {
            session_destroy();
            $aResult = ["status" => 200, "json" => "Session is closed"];
            return $aResult;
        } else {
            $aResult = ["status" => 401, "json" => "Unauthorized operation"];
            return $aResult;
        }
    }

    public function get() {
        if ($this->checkPermission()) {
            $id = $json['id'];
            $connection = new ConnectionHelper();
            try {
                $oDao = new userDao();
                $oResult = $oDao->get($json);
                $aResult = ["status" => 200, "json" => $oResult];
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            }
            return $oReplyBean;
        } else {
            $aResult = ["status" => 401, "json" => "Unauthorized operation"];
            return $aResult;
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

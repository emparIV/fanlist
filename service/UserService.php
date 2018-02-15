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

    public function get($json) {
        if ($this->checkPermission()) {
            $id = $json['id'];
            try {
                $oDao = new userDao();
                $oResult = $oDao->get($id);
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
    
    public function set($json) {
        if ($this->checkPermission()) {
            try {
                $oDao = new userDao();
                $oResult = $oDao->set($json);
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
    
    public function remove($json) {
        if ($this->checkPermission()) {
            $id = $json['id'];
            try {
                $oDao = new userDao();
                $oResult = $oDao->remove($id);
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

    public function getCount() {
        if ($this->checkPermission()) {
            try {
                $oDao = new userDao();
                $oResult = $oDao->getCount();
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

    public function getPage($json) {
        if ($this->checkPermission()) {
            $np = $json['np'];
            $rpp = $json['rpp'];
            try {
                $oDao = new userDao();
                $oResult = $oDao->getPage($np, $rpp);
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

    

    

}

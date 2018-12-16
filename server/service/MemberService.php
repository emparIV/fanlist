<?php

/**
 * Description of MemberService
 *
 * @author Empar Ibáñez
 */
class MemberService implements ServiceTableInterface, ServiceViewInterface {
    
    private function checkPermission() {
        if (isset($_SESSION[member]) || isset($_SESSION[user])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function checkLogin() {
        if (isset($_SESSION[member])) {
            $oResult = $_SESSION[member];
            return ["status" => 200, "json" => $oResult];
        } else {
            return ["status" => 401, "json" => "No existe una sesión"];
        }
    }
    
    public function login($json) {
        if (!($json['username']) == "" && !($json['password']) == "") {
            try {
                $oDao = new MemberDao();
                $oResult = $oDao->getFromLoginAndPass($json);
                $_SESSION['member'] = $oResult;
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
        if (isset($_SESSION[user]) || isset($_SESSION[member])) {
            $id = $json['id'];
            try {
                $oDao = new MemberDao();
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
        try {
            $oDao = new MemberDao();
            $oResult = $oDao->set($json);
            $aResult = ["status" => 200, "json" => $oResult];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $aResult;   
    }
    
    public function remove($json) {
        if ($this->checkPermission()) {
            $id = $json['id'];
            try {
                $oDao = new MemberDao();
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
                $oDao = new MemberDao();
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
                $oDao = new MemberDao();
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

    public function getProfile($json) {
        if (isset($_SESSION[member])) {
            $id = $_SESSION[member][id];
            try {
                $oDao = new MemberDao();
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

    

}

<?php

/**
 * Description of rulesService
 *
 * @author Empar Ibáñez
 */
class RulesService implements ServiceTableInterface, ServiceViewInterface {
    
    public function get($json) {
        $id = $json['id'];
        try {
            $oDao = new RulesDao();
            $oResult = $oDao->get($id);
            $aResult = ["status" => 200, "json" => $oResult];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $aResult;
    }
    
    public function set($json) {
        if (isset($_SESSION[user])) {
            try {
                $oDao = new RulesDao();
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
        if (isset($_SESSION[user])) {
            $id = $json['id'];
            try {
                $oDao = new RulesDao();
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
                $oDao = new RulesDao();
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
        $np = $json['np'];
        $rpp = $json['rpp'];
        try {
            $oDao = new RulesDao();
            $oResult = $oDao->getPage($np, $rpp);
            $aResult = ["status" => 200, "json" => $oResult];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $aResult;
    }

    private function checkPermission() {
        if (isset($_SESSION[user]) || isset($_SESSION[member])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    

}

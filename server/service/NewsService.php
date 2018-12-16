<?php

/**
 * Description of newsService
 *
 * @author Empar Ibáñez
 */
class NewsService implements ServiceTableInterface, ServiceViewInterface {
    
    public function get($json) {
        if ($this->checkPermission()) {
            $id = $json['id'];
            try {
                $oDao = new NewsDao();
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
        if (isset($_SESSION[user])) {
            try {
                $oDao = new NewsDao();
                $json['user_id'] = $_SESSION[user][id];
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
                $oDao = new NewsDao();
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
                $oDao = new NewsDao();
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
                $oDao = new NewsDao();
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

    private function checkPermission() {
        if (isset($_SESSION[user]) || isset($_SESSION[member])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    

}

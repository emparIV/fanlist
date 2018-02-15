<?php


/**
 * Description of MappingHelper
 *
 * @author Empar Ibáñez
 */
class MappingHelper {

    public function mapping($ob, $op, $json) {
        $aResult = NULL;
        switch ($ob) {
            case "user":
                $oUserService = new UserService();
                switch ($op) {
                    case "login":
                        $aResult = $oUserService->login($json);
                        break;
                    case "logout":
                        $aResult = $oUserService->logout($json);
                        break;
                    case "get":
                        $aResult = $oUserService->get($json);
                        break;
                    case "set":
                        $aResult = $oUserService->set($json);
                        break;
                    case "remove":
                        $aResult = $oUserService->remove($json);
                        break;
                    case "getCount":
                        $aResult = $oUserService->getCount();
                        break;
                    case "getPage":
                        $aResult = $oUserService->getPage($json);
                        break;
                }
                break;
            default:
                return $aResult = ["status" => 500, "json" =>  "Object not found : Please contact your administrator"];
                break;
        }
        return $aResult;
    }

}

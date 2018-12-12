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
                    case "checkLogin":
                        $aResult = $oUserService->checkLogin();
                        break;
                }
                break;
            case "rules":
                $oRulesService = new RulesService();
                switch ($op) {
                    case "get":
                        $aResult = $oRulesService->get($json);
                        break;
                    case "set":
                        $aResult = $oRulesService->set($json);
                        break;
                    case "remove":
                        $aResult = $oRulesService->remove($json);
                        break;
                    case "getCount":
                        $aResult = $oRulesService->getCount();
                        break;
                    case "getPage":
                        $aResult = $oRulesService->getPage($json);
                        break;
                }
                break;
            case "news":
                $oNewsService = new NewsService();
                switch ($op) {
                    case "get":
                        $aResult = $oNewsService->get($json);
                        break;
                    case "set":
                        $aResult = $oNewsService->set($json);
                        break;
                    case "remove":
                        $aResult = $oNewsService->remove($json);
                        break;
                    case "getCount":
                        $aResult = $oNewsService->getCount();
                        break;
                    case "getPage":
                        $aResult = $oNewsService->getPage($json);
                        break;
                }
                break;
            case "member":
                $oMemberService = new MemberService();
                switch ($op) {
                    case "login":
                        $aResult = $oMemberService->login($json);
                        break;
                    case "logout":
                        $aResult = $oMemberService->logout($json);
                        break;
                    case "get":
                        $aResult = $oMemberService->get($json);
                        break;
                    case "set":
                        $aResult = $oMemberService->set($json);
                        break;
                    case "remove":
                        $aResult = $oMemberService->remove($json);
                        break;
                    case "getCount":
                        $aResult = $oMemberService->getCount();
                        break;
                    case "getPage":
                        $aResult = $oMemberService->getPage($json);
                        break;
                    case "checkLogin":
                        $aResult = $oMemberService->checkLogin();
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

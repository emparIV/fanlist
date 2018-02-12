<?php



/**
 * Description of MappingHelper
 *
 * @author Empar Ibáñez
 */
class MappingHelper {

    public static function mappingHelper($ob, $op, $json) {
        $oReplyBean = NULL;
        switch ($ob) {
            case "user":
                $oUsuarioService = new UsuarioService();
                switch ($op) {
                    case "login":
                        $aResult = [$oUsuarioService->login($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                    case "logout":
                        $aResult = [$oUsuarioService->logout($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                    case "get":
                        $aResult = [$oUsuarioService->get($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                    case "set":
                        $aResult = [$oUsuarioService->set($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                    case "remove":
                        $aResult = [$oUsuarioService->remove($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                    case "getCount":
                        $aResult = [$oUsuarioService->getCount($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                    case "getPage":
                        $aResult = [$oUsuarioService->getPage($json)];
                        $oReplyBean = new ReplyBean($aResult);
                        break;
                }
                break;
            default:
                $aResult = [500, "Object not found : Please contact your administrator"];
                $oReplyBean = new ReplyBean($aResult);
                break;
        }
        return $oReplyBean;
    }

}

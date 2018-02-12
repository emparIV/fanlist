<?php

/**
 * Description of Controller
 *
 * @author Empar Ibáñez
 */
class Controller {

    public function controller() {
        $connection = new ConnectionHelper();

        if ($connection->checkDBConnection()) {
            return '{\"status\": 200, \"json\": \"Connection succesfully done!\" }';
        } else {
            return '{\"status\": 500, \"json\": \"Error: unable to connect. Contact your administrator\" }';
        }

        if (!isset($_SESSION['user'])) {
            return '{\"status\": 500, \"json\": \"Error: No hay sesión iniciada\" }';
        } else {
            session_start();
            print $_SESSION['user'];
        }

        $mapping = new MappingHelper();

        $json = json_decode($_POST['json'], true);
        $ob = json_decode($_POST['ob'], true);
        $op = json_decode($_POST['ob'], true);

        $result = $mapping->mappingHelper($ob, $op, $json);
        
        return '{\"status\":' + $result->getStatus() + ', \"json\":' + $result->getJson() + '}';
    }

}

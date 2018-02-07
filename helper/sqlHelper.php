<?php

require '../helper/FilterBeanHelper.php';

/**
 * Description of sqlHelper
 *
 * @author a053881694p
 */
class sqlHelper {
    public function buildSqlLimit($totalRegs, $regsPerPage, $pageNumber) {
        $SQLLimit = "";
        if ($regsPerPage > 0 && $regsPerPage < 10000) {
            if ($pageNumber > 0 && $intPageNumber <= (ceil(($totalRegs / $regsPerPage) + 1))) {
                $SQLLimit = " LIMIT " . ($pageNumber - 1) * $regsPerPage . " , " . $regsPerPage;
            } else {
                $SQLLimit = " LIMIT 0 ";
            }
        }
        return $SQLLimit;
        
    }
    
    public function buildSqlOrder($array) {
        $strSQLOrder = "";
        if ($array != null) {
            foreach($array as $key => $value) {
                $strSQLOrder += $key;
                $strSQLOrder += " ";
                $strSQLOrder += $value;
                $strSQLOrder += ",";
            }
            $strSQLOrder = " ORDER BY " . substr($strSQLOrder, 0, strlen($strSQLOrder) - 1);
        }
        return $strSQLOrder;
        
    }
    
    private function getFilterExpression($temp) {
        switch ($temp.getOperation()) {
            //operations for date ----------------------------------------------
            case "dequa": //equal 
                return $temp->link . " " . $temp->field . " = '" . $temp->value . "' ";
            case "dnequ": //not equal
                return $temp->link . " " . $temp->field . " != '" . $temp->value . "' ";
            case "dlowe": //lower than
                return $temp->link . " " . $temp->field . " < '" . $temp->value . "' ";
            case "dlequ": //lower or equal than
                return $temp->link . " " . $temp->field . " <= '" . $temp->value . "' ";
            case "dgrea": //greater than
                return $temp->link . " " . $temp->field . " > '" . $temp->value . "' ";
            case "dgequ": //greater or equal than
                return $temp->link . " " . $temp->field . " >= '" . $temp->value . "' ";
            //operations for strings -------------------------------------------
            case "sequa": //equal for strings
                return $temp->link . " " . $temp->field . " = '" . $temp->value . "' ";
            case "snequ": //not equal for strings
                return $temp->link . " " . $temp->field . " != '" . $temp->value . "' ";
            case "slike": //like
                return $temp->link . " " . $temp->field . " LIKE '%" . $temp->value . "%' ";
            case "snlik": //not like
                return $temp->link . " " . $temp->field . " NOT LIKE '%" . $temp->value . "%' ";
            case "sstar": //starts with
                return $temp->link . " " . $temp->field . " LIKE '" . $temp->value . "%' ";
            case "snsta": //not starts with
                return $temp->link . " " . $temp->field . " NOT LIKE '" . $temp->value . "%' ";
            case "sends": //ends with
                return $temp->link . " " . $temp->field . " LIKE '%" . $temp->value . "' ";
            case "snend": //not ends with
                return $temp->link . " " . $temp->field . " NOT LIKE '%" . $temp->value . "' ";
            //operations for numbers -------------------------------------------
            case "nequa": //equal for numbers
                return $temp->link . " " . $temp->field . " = " . $temp->value . " ";
            case "nnequ": //not equal for numbers
                return $temp->link . " " . $temp->field . " != " . $temp->value . " ";
            case "nlowe": //lower than
                return $temp->link . " " . $temp->field . " < " . $temp->value . " ";
            case "nlequ": //lower or equal than
                return $temp->link . " " . $temp->field . " <= " . $temp->value . " ";
            case "ngrea": //greater than
                return $temp->link . " " . $temp->field . " > " . $temp->value . " ";
            case "ngequ": //greater or equal than
                return $temp->link . " " . $temp->field . " >= " . $temp->value . " ";
            //operations for boolean -------------------------------------------
            case "bequa": //equal for boolean
                return $temp->link . " " . $temp->field . " = " . $temp->value . " ";
            //------------------------------------------------------------------
            default:
                throw new Error("Filter expression malformed. Operator not valid.");
        }
    }
    
    public function buildSqlFilter($array) {
        $strSQLFilter = "";
        if ($array != null) {
            foreach ($array as $key => $value) {
                $strSQLFilter += getFilterExpression($key);
            }
        }
        return $strSQLFilter;
    }
}

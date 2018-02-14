<?php

/**
 *
 * @author Empar
 */
interface DaoViewInterface {
    public function getCount($bean);
    public function getPage($regsPerPage, $page, $alOrder, $alFilter);
}

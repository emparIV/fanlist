<?php

/**
 *
 * @author Empar
 */
interface DaoViewInterface {
    public function getCount();
    public function getPage($regsPerPage, $page);
}

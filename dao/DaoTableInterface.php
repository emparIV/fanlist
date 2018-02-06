<?php
/**
 *
 * @author Empar
 */
interface DaoTableInterface {
    public function get($bean);
    public function set($bean);
    public function remove($bean);
}

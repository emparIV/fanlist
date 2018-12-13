<?php
/**
 *
 * @author Empar
 */
interface DaoTableInterface {
    public function get($id);
    public function set($id);
    public function remove($id);
}

<?php

/**
 *
 * @author Empar
 */
interface ServiceTableInterface {
    public function set($json);
    public function get($json);
    public function remove($json);
}

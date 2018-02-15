<?php

/**
 *
 * @author Empar
 */
interface ServiceTableInterface {
    public function set($json);
    public function get();
    public function remove();
}

<?php

/**
 * Description of FilterBeanHelper
 *
 * @author a053881694p
 */
class FilterBeanHelper {
    private $link;
    private $field;
    private $operation;
    private $value;
    
    public function __construct($link, $field, $operation, $value) {
        $this->link = $link;
        $this->field = $field;
        $this->operation = $operation;
        $this->value = $value;
    }

    
    public function getLink() {
        return $this->link;
    }

    public function getField() {
        return $this->field;
    }

    public function getOperation() {
        return $this->operation;
    }

    public function getValue() {
        return $this->value;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setField($field) {
        $this->field = $field;
    }

    public function setOperation($operation) {
        $this->operation = $operation;
    }

    public function setValue($value) {
        $this->value = $value;
    }


}

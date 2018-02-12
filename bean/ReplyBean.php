<?php


/**
 * Description of ReplyBean
 *
 * @author Empar Ibáñez
 */
class ReplyBean {
    public $status;
    public $json;
    
    public function construct($properties){        
        foreach($properties as $key => $value){
            $this->{$key} = $value;
        }
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function getJson() {
        return $this->json;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setJson($json) {
        $this->json = $json;
    }

}

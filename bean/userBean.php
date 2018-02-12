<?php

/**
 * Description of userBean
 *
 * @author Empar Ibáñez
 */
class userBean {
    private $id;
    private $name;
    private $mail;
    private $username;
    private $password;
    private $url;
    private $profile_pic;
    private $custom_field1;
    private $custom_field2;
    private $custom_field3;
    private $custom_field4;
    private $custom_field5;
    
    public function construct($array){        
        foreach($array as $key => $value){
            $this->{$key} = $value;
        }
    }
}

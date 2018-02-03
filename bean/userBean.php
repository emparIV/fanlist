<?php

/**
 * Description of userBean
 *
 * @author a053881694p
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
    
    
    public function __construct($id, $name, $mail, $username, $password, $url, $profile_pic, $custom_field1, $custom_field2, $custom_field3, $custom_field4, $custom_field5) {
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
        $this->profile_pic = $profile_pic;
        $this->custom_field1 = $custom_field1;
        $this->custom_field2 = $custom_field2;
        $this->custom_field3 = $custom_field3;
        $this->custom_field4 = $custom_field4;
        $this->custom_field5 = $custom_field5;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getProfile_pic() {
        return $this->profile_pic;
    }

    public function getCustom_field1() {
        return $this->custom_field1;
    }

    public function getCustom_field2() {
        return $this->custom_field2;
    }

    public function getCustom_field3() {
        return $this->custom_field3;
    }

    public function getCustom_field4() {
        return $this->custom_field4;
    }

    public function getCustom_field5() {
        return $this->custom_field5;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setProfile_pic($profile_pic) {
        $this->profile_pic = $profile_pic;
    }

    public function setCustom_field1($custom_field1) {
        $this->custom_field1 = $custom_field1;
    }

    public function setCustom_field2($custom_field2) {
        $this->custom_field2 = $custom_field2;
    }

    public function setCustom_field3($custom_field3) {
        $this->custom_field3 = $custom_field3;
    }

    public function setCustom_field4($custom_field4) {
        $this->custom_field4 = $custom_field4;
    }

    public function setCustom_field5($custom_field5) {
        $this->custom_field5 = $custom_field5;
    }
  
}

<?php

/**
 * @Entity @Table(name="sh_network_token")
 */
class AddToken {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $token_id;
    /** @Column(type="string") */
    protected $networkname;
    /** @Column(type="string") */
    protected $auth_token;
    /** @Column(type="string") */
    protected $auth_secret;
    /** @Column(type="integer") */
    protected $user_id;
    /** @Column(type="string") */
    protected $screen_name;
    /** @Column(type="string") */
    protected $screen_id;
    /** @Column(type="integer") */
    protected $count;


    public function getTokenId() {
        return $this->token_id;
    }
    public function getCount($count){
     return $this->count;
    }

    public function setCount($count) {
        $this->count = $count;
    }
    public function getScreenName() {
        return $this->screen_name;
    }

    public function setScreenName($screen_name) {
        $this->screen_name = $screen_name;
    }

    public function getScreenID() {
        return $this->screen_id;
    }

    public function setScreenID($screen_id) {
        $this->screen_id = $screen_id;
    }
    
    public function getNetworkName() {
        return $this->networkname;
    }

    public function setNetworkName($networkname) {
        $this->networkname = $networkname;
    }

    public function getAuthToken() {
        return $this->auth_token;
    }

    public function setAuthToken($auth_token) {
        $this->auth_token = $auth_token;
    }

    public function getAuthSecret() {
        return $this->auth_secret;
    }

    public function setAuthSecret($auth_secret) {
        $this->auth_secret = $auth_secret;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

}
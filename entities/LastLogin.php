<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @Entity @Table(name="last_login")
 */
class LastLogin {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $login_id;
    /** @Column(type="string") */
    protected $ipaddress;
    /** @Column(type="string") */
    protected $login_date;
    /** @Column(type="string") */
    protected $device;
    /** @Column(type="integer") */
    protected $user_id;
    /** @Column(type="string") */
    protected $logout_date;

    public function getLoginId() {
        return $this->login_id;
    }

    public function setIPAddress($ipaddress) {
        $this->ipaddress = $ipaddress;
    }

    public function getIPAddress($ipaddress) {
        return $this->ipaddress;
    }

    public function setLoginDate($login_date) {
        $this->login_date = $login_date;
    }

    public function getLoginDate($login_date) {
        return $this->login_date;
    }

    public function setDevice($device) {
        $this->device = $device;
    }

    public function getDevice($device) {
        return $this->device;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setLogoutDate($logout_date) {
        $this->logout_date = $logout_date;
    }

    public function getLogoutDate($logout_date) {
        return $this->logout_date;
    }

}
?>
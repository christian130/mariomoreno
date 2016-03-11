<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author sathish
 */
class Session {

    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function setSession($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function getSession($name) {
        return $_SESSION[$name];
    }

    public function is_val_exists($needle, $haystack) {
        if (in_array($needle, $haystack)) {
            return true;
        }
        foreach ($haystack as $element) {
            if (is_array($element) && is_val_exists($needle, $element))
                return true;
        }
        return false;
    }

}
?>
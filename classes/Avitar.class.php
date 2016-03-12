<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Avitar
 *
 * @author sathish
 */
require_once('./lib/tumblroauth/tumblroauth.php');
require_once('./config/config.php');
require_once 'Session.class.php';

class Avitar {

    //put your code here
    function getProfileImg($blog_name) {
        $data = array();
        $consumer_key = TUMBLR_CONSUMER_KEY;
        $consumer_secret = TUMBLR_CONSUMER_SECRET;
        $session = new Session();
        $tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $session->getSession('auth_token_tumblr'), $session->getSession('auth_secret_tumblr'));
        $avaitar = $tum_oauth->get("http://api.tumblr.com/v2/blog/".$blog_name.".tumblr.com/avatar/128");
        array_push($data,array("avaitar" => $avaitar));
        return $data;
    }

}
?>

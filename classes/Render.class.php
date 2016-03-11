<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Render
 *
 * @author sathish
 */
class Render {

    //put your code here

    function redirect($url) {
        $file_headers = @get_headers($url);
        if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            header("Location:notfound");
        } else {
            header("Location:".$url);
        }
    }

}
?>

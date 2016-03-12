<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autoload
 *
 * @author admin
 */
function __autoload($className) {
    $file = './classes/'.$className . '.class.php';

    if(file_exists($file)) {
        require_once $file;
    }
}
?>

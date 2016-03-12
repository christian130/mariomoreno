<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author sathish
 */
class View {

    //put your code here
    public $templatename;
    public $parms = array();
    public $ext = ".php";

    public function __construct($templatename, $parms) {
        $this->parms = $parms;
        $this->templatename = $templatename;
        $this->view($this->templatename,$this->parms);
    }

    public function view($templatename,$parms) {
       $parms;
        include "html/" . $templatename . $this->ext;
    }

}
?>

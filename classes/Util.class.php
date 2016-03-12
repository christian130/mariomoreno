<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author Sathish
 */
class Util {

   public static function IGTimeCalculation($oldTime) {
        $newTime = date("Y-m-d H:i:s");
        $timeType = "x";
        $timeCalc = (strtotime($newTime) - $oldTime) / 60;
        if ($timeType == "x") {
            if (round($timeCalc) < 60) {
                $timeType = "m";
            } else if (round($timeCalc) < 3600) {
                $timeType = "h";
            } else {
                $timeType = "d";
            } 
        }
        if ($timeType == "s") {
            $timeCalc .= " seconds ago";
        } else if ($timeType == "m") {
            $timeCalc = round($timeCalc) . " minutes ago";
        } else if ($timeType == "h") {
            $timeCalc = round($timeCalc / 60) . " hours ago";
        } else if ($timeType == "d") {
            $timeCalc = round($timeCalc /(24*60)) . " days ago";
        } 
        return $timeCalc;
    }

}
?>

<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$video_id = $_POST['vine_id'];
echo'<p style="text-align:left;"><i class="fa fa-vine" style="background-image: none !important;color:#26bd97;margin-top:3px;margin-right:3px;"></i> Vine</p>';
echo "<iframe src='https://vine.co/v/" . $video_id . "/card?mute=1' width='450px' height='506px' frameborder='0'></iframe>"
?>
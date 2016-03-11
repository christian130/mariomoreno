<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Twitter.php';
$account_id = $_GET['account_id'];
$res = Twitter::deleteAccount($account_id,$entityManager);
?>

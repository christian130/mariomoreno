<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Twitter.php';
require_once 'classes/Session.class.php';
$session = new Session();
if($_GET['profile_id'] != null){
$data = array("screen_id" => $_POST['twitter_screenid'], "userid" => $_GET['profile_id']);
} else {
$data = array("screen_id" => $_POST['twitter_screenid'], "userid" => $session->getSession("userid"));
}
//$tokens = Twitter::getAllTwitterActive($data, $entityManager);
$entityManager->getConnection()->beginTransaction();
try {
    $dql = "SELECT a FROM AddToken a WHERE a.user_id = ?1 and a.screen_id = ?2";
    $query = $entityManager->createQuery($dql);
    $query->setResultCacheId('my_custom_id');
    $query->useResultCache(true, 3600, 'my_custom_id');
    $query->setParameter(1, $data['userid']);
    $query->setParameter(2, $data['screen_id']);
    $tokens = $query->getArrayResult();
} catch (Exception $e) {
    $entityManager->getConnection()->rollback();
    $entityManager->close();
    throw $e;
}
$session->setSession($tokens[0]['networkname'], 1);
$session->setSession("screen_name_" . $tokens[0]['networkname'], $tokens[0]['screen_name']);
$session->setSession("screen_id_" . $tokens[0]['networkname'], $tokens[0]['screen_id']);
$session->setSession("auth_token_" . $tokens[0]['networkname'], $tokens[0]['auth_token']);
$session->setSession("auth_secret_" . $tokens[0]['networkname'], $tokens[0]['auth_secret']);
if (count($tokens) != '') {
    $success = array("success" => 1);
    echo json_encode($success);
} else {
    $success = array("success" => 0);
    echo json_encode($success);
}
?>

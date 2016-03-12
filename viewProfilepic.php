<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
$session = new Session();
$profileid = $_GET['profileid'];
$data = array("userid" => $profileid);
$profilepic = Signup::profileView($data, $entityManager);
?>
<img src="uploads/<?php echo $profilepic[0]['profile_pic']; ?>" alt="" style="border-radius:0px; " id="profile_img" width="585px" height="585px"/>
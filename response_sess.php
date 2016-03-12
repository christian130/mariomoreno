
<?php
require_once "config.php";
require_once "bootstrap.php";
require_once 'model/Notification.php';
require_once 'classes/Session.class.php';
require_once 'entities/Friend.php';
require_once 'entities/Notification.php';
require_once 'model/Friends.php';
require_once 'model/Notification.php';
require_once 'model/SendMail.php';
require_once 'classes/Session.class.php';

if($_POST['name']=="tarun")
{
echo "yes";

$sql = mysql_query("DELETE FROM notifications where id_notifications=412 ");

} 


?>

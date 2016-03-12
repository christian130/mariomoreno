
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<link href="css/registration-process.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="js/invites.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<?php
require 'bootstrap.php';

if (isset($_GET['token'])) {
	$result = curl_init("https://www.google.com/accounts/AuthSubSessionToken");
	curl_setopt($result, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($result, CURLOPT_HTTPHEADER, array("Authorization: AuthSub token=\"".$_GET['token']."\""));
	curl_setopt($result, CURLOPT_VERBOSE, 1);
	curl_setopt ($result, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($result, CURLOPT_TIMEOUT, 120);
	$response_h = curl_exec($result);
	curl_close($result);
	// get the sessiontoken
	$pieces = explode("Token=", $response_h);

	$session = curl_init("http://www.google.com/m8/feeds/contacts/default/full?alt=json");
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($session, CURLOPT_HTTPHEADER, array("Authorization: AuthSub token=\"".$pieces[1]."\""));
	curl_setopt($session, CURLOPT_VERBOSE, 1);
	curl_setopt ($session, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($session, CURLOPT_TIMEOUT, 120);
	$response_session = curl_exec($session);
	curl_close($session);
			
	//get the data to an array			
        $testArray = array();
	$json_a=json_decode($response_session, true);
	foreach($json_a['feed']['entry'] as $contact) {
	$testArray[] = 	array( 
            'email' => $contact['gd$email']['0']['address'],
            'name'=>$contact['title']['$t']           
        );
	}
$session = new Session();
$session->setSession('email_import', array());

//$testArray = array(
//    array('email' => 'doutorx@gmail.com', 'name' => ' Louco'),
//    array('email' => 'doutorx2@gmail.com', 'name' => ' Louco2'),
//    array('email' => 'doutorxcadas@gmail.com', 'name' => ' Mad Man'),
//    array('email' => 'marcel.nagm@gmail.com', 'name' => ' Marcel Nagm'),
//    array('email' => 'marcel@gmail.com', 'name' => ' Man to')
//);
?>
<table>
    <tbody>            
        <?php
        $i = 0;
        foreach ($testArray as $item) {
            ?>
            <tr style="text-align: center;">
                <td>
                    <input type="checkbox" value="" id="contact_<?php echo $i;?>">
                </td>
                <td>                    
                    <?php echo $item['name'] ?> 
                </td>
                <td style="margin-left: 4px; padding: 4px;" id="contact_<?php echo $i;?>">
                    
                    <?php
                    echo Invites::checkIfHave($entityManager, array('email' => $item['email'],'name' => $item['name'])) . '<br>';
                    $i++;
//}else{            
                    ?>
                    
                </td></tr>
        <?php } ?>
    </tbody>
</table>
<br>

<input class="btn btn-success" type="button" value="Send invites/request All" onclick="sendInviteAll('', '', '');">



<?php
}else{ ?>
<a href="https://www.google.com/accounts/AuthSubRequest?scope=http%3A%2F%2Fwww.google.com%2Fm8%2Ffeeds%2F&session=1&secure=0&next=http://localhost:81/whatsdadilly/inviteGoogle.php" >Authorize with GOOGLE<a/>
    <?php }?>
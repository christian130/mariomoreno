
<script type="text/javascript">
    $(document).ready(function() {
<?php
//require_once '../model/Notification.php';
//require_once '../model/Friends.php';
$conn=mysql_connect("localhost","root","(}0#n.oxn9rq") or die ("not connceted");
$db=mysql_select_db("sathish_wdd",$conn) or die ("not connceted");
$iduser= $session->getSession('userid');
?>
	 	 $(".first").click(function(){                                
       $( ".notify" ).replaceWith( " " );          
<?php
 $sql=mysql_query("UPDATE notifications set `readed`=1 where `readed`=0 and `id_user`=$iduser");
  
?>

	    });  }); </script>
	
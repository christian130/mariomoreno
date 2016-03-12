<?php
$iduser= $session->getSession('userid');
$conn=mysql_connect("localhost","root","toor") or die ("not connceted");
$db=mysql_select_db("wwwwhats_betaPhase",$conn) or die ("not connceted");
 $sql=mysql_query("UPDATE notifications set `readed`=1 where `readed`=0 and `id_user`=$iduser");
?>
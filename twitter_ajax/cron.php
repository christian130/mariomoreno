<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 require('_config-rating.php');
		$query = mysql_query("SELECT * FROM jos_jwd_order_details WHERE orderdate = DATE_ADD(CURDATE(), INTERVAL +7 DAY) and publish='1'")or die(" Error: ".mysql_error());
while ($data_list = mysql_fetch_assoc($query))
{
            $querys = "SELECT sql_no_cache js.id as sid,js.fname,js.lname,js.school,ju.id as pid,ju.email,ju.`name`,ju.phonenumber
			FROM jos_student as js INNER JOIN jos_users as ju on ju.id=js.parentid
			where js.id not in (select student_id from jos_jwd_parent_order WHERE orderdate=".$data_list['orderdate']." and school_id=".$data_list['school_id'].")
			AND js.school=".$data_list['school_id']." ORDER BY js.id ASC";
			$queryd = mysql_query($querys)or die(" Error: ".mysql_error());
			echo '<pre>';
			print_r(mysql_fetch_assoc($queryd));exit;
            while ($py = mysql_fetch_assoc($queryd))
{
            $to = $py['email'];
            $subject = ucfirst($py['school_name']).'Fun Lunch Reminder';
            $txt = 'Just a friendly reminder to place your orders for next weeks Fun Lunch. Please go to www.HealthyHunger.ca to order. All orders must be in 5 days before your Schools Fun Lunch date.';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From:info@healthyhunger.com" . "\r\n";
            mail($to, $subject, $txt, $headers);
            }
        }
           
?>

<?php
$url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=2b3d7d0ad1a285279139487ce77f3f58d980eea9546b5ccc5d08f5ee62ce7471&ip=".$_SERVER['REMOTE_ADDR']."&format=json"));

echo "<table border='1' width='50%' align='center'><tr><td>COUNTRY:</td><td>";
echo $url->countryName;
echo "</td></tr><tr><td>CITY:</td><td>";
echo $url->cityName;
echo "</td></tr><tr><td>STATE OR REGION:</td><td>";
echo $url->regionName;
echo "</td></tr><tr><td>IP ADDRESS:</td><td>";
echo $url->ipAddress;
echo "</td></tr><tr><td>COUNTRY CODE:</td><td>";
echo $url->countryCode;
echo "</td></tr><tr><td>LATITUTE:</td><td>";
echo $url->latitude;
echo "</td></tr><tr><td>LONGITUDE:</td><td>";
echo $url->longitude;
echo "</td></tr><tr><td>TIMEZONE:</td><td>";
echo $url->timeZone;
echo "</td></tr><tr></table>";

print_r(geoCheckIP($_SERVER['REMOTE_ADDR']));
       //Array ( [domain] => dslb-094-219-040-096.pools.arcor-ip.net [country] => DE - Germany [state] => Hessen [town] => Erzhausen )

       //Get an array with geoip-infodata
       function geoCheckIP($ip)
       {
               //check, if the provided ip is valid
               if(!filter_var($ip, FILTER_VALIDATE_IP))
               {
                       throw new InvalidArgumentException("IP is not valid");
               }

               //contact ip-server
               $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
               if (empty($response))
               {
                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");
               }

               //Array containing all regex-patterns necessary to extract ip-geoinfo from page
               $patterns=array();
               $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
               $patterns["country"] = '#Country: (.*?)&nbsp;#i';
               $patterns["state"] = '#State/Region: (.*?)<br#i';
               $patterns["town"] = '#City: (.*?)<br#i';

               //Array where results will be stored
               $ipInfo=array();

               //check response from ipserver for above patterns
               foreach ($patterns as $key => $pattern)
               {
                       //store the result in array
                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
               }

               return $ipInfo;
       }

?>
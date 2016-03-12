<?php
 
class IPAPI {
    static $fields = 65535;     // refer to http://ip-api.com/docs/api:returned_values#field_generator
    static $use_xcache = true;  // set this to false unless you have XCache installed (http://xcache.lighttpd.net/)
    static $api = "http://ip-api.com/php/";
 
    public $status, $country, $countryCode, $region, $regionName, $city, $zip, $lat, $lon, $timezone, $isp, $org, $as, $reverse, $query, $message;
 
    public static function query($q) {
        $data = self::communicate($q);
        $result = new static;
        foreach($data as $key => $val) {
            $result->$key = $val;
        }
        return $result;
    }
 
    private function communicate($q) {
        $q_hash = md5('ipapi'.$q);
        if(self::$use_xcache && xcache_isset($q_hash)) {
            return xcache_get($q_hash);
        }
        if(is_callable('curl_init')) {
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, self::$api.$q.'?fields='.self::$fields);
            curl_setopt($c, CURLOPT_HEADER, false);
            curl_setopt($c, CURLOPT_TIMEOUT, 30);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            $result_array = unserialize(curl_exec($c));
            curl_close($c);
        } else {
            $result_array = unserialize(file_get_contents(self::$api.$q.'?fields='.self::$fields));
        }
        if(self::$use_xcache) {
            xcache_set($q_hash, $result_array, 86400);
        }
        return $result_array;
    }
}
 
 
// example
$query = IPAPI::query("google.com");
echo 'Country: '.$query->country.', city: '.$query->city;
 
echo '<br><br>debug: <pre>';
var_dump($query);
echo '</pre>';

$ip = $_REQUEST['REMOTE_ADDR']; // the IP address to query
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
  echo 'Hello visitor from '.$query['country'].', '.$query['city'].'!';
} else {
  echo 'Unable to get location';
}
?>
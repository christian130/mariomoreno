<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
//include_once("../model/Twitter.php");
$screenname = $_SESSION['screen_name_twitter']; //$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$view_summary = $connection->get("https://api.twitter.com/1.1/statuses/show.json?id=" . $_POST['retweet_id']);
$expand_url = expandUrlLongApi($view_summary->entities->urls[0]->url);
if ($expand_url['response-code'] == 200) {
    $PAGE_url = $expand_url['long-url'];
} else {
    $PAGE_url = $my_tweet->entities->urls[0]->url;
}
$html = file_get_contents($PAGE_url);
$doc = new DOMDocument();
$doc->loadHTML($html);
foreach( $doc->getElementsByTagName('meta') as $meta ) {
    if($meta->getAttribute('property') == 'og:image'){
             $image = $meta->getAttribute('content');
    }
     if($meta->getAttribute('property') == 'og:title'){
             $title = $meta->getAttribute('content');
    }
    if($meta->getAttribute('property') == 'og:description'){
             $description = $meta->getAttribute('content');
    }
       $meta->getAttribute('property');
       $meta->getAttribute('content');
}
function expandUrlLongApi($url)
 {
        $format = 'json';
        $api_query = "http://api.longurl.org/v2/expand?" .
                    "url={$url}&response-code=1&format={$format}";
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $api_query );
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $fileContents = curl_exec($ch);
        curl_close($ch);

        $s1=str_replace("{"," ","$fileContents");
       $s2=str_replace("}"," ","$s1");
        return json_decode($fileContents, true);
 }
?>
<table width="100%" align="center">
    <tr>
        <td style="vertical-align: top;padding: 5px;width:100px;">
            <img src="<?php echo $image; ?>" style="width:100px;height:100px;" />
        </td>
        <td style="vertical-align:top;">
            <table>
                <tr>
                    <td style="vertical-align:top;">
                        <a href="<?php echo $PAGE_url; ?>" target="_blank"><h4 style="text-align: left;font-size: 14px;margin:0px;"><?php echo $title; ?></h4></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align: left;font-size: 12px;color:#333;"><?php echo $description; ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
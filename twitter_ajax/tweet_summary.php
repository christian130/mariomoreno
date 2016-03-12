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
    $html = getHTML($expand_url['long-url'], 20);
    $tags = get_meta_tags($expand_url['long-url']);
    $PAGE_url = $expand_url['long-url'];
} else {
    $html = getHTML($my_tweet->entities->urls[0]->url, 20);
    $tags = get_meta_tags($expand_url['long-url']);
    $PAGE_url = $my_tweet->entities->urls[0]->url;
}
preg_match("/<title>(.*)<\/title>/i", $html, $match);
$imge = getImageNme($PAGE_url);
function expandUrlLongApi($url) {
    $format = 'json';
    $api_query = "http://api.longurl.org/v2/expand?" .
            "url={$url}&response-code=1&format={$format}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $fileContents = curl_exec($ch);
    curl_close($ch);
    $s1 = str_replace("{", " ", "$fileContents");
    $s2 = str_replace("}", " ", "$s1");
    return json_decode($fileContents, true);
}

function getHTML($url, $timeout) {
    $ch = curl_init($url); // initialize curl with given url
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
    curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
    return @curl_exec($ch);
}
function getImageNme($PAGE_url) {
$data = file_get_contents($PAGE_url);
$pattern = '/src=[\”‘]?[""]([^\”‘]?.*(png|jpg|jpeg))[\”‘]?/i';
preg_match_all($pattern, $data, $images);

for ($i = 0; $i < count($images[1]); $i++) {
    $src = $images[1][$i];
    $htt = explode('http://', $src);
    $pos = count($htt);
    if ($pos == 1) {
        $domain = explode('//', $PAGE_url);
        $host_name = explode('/', $domain[1]);
        $src1 = $domain[0] . "//" . $host_name[0] . $src;


        //list($w, $h)
//        echo $src1;
        list($w, $h) = getimagesize($src1);
//         echo $size;
//         print_r($size);
//         exit;
        if ($w >= 250 && $h >= 200) {
            $imge = $src1;
            return $imge;
        }
    } else {
        list($w, $h) = getimagesize($src);
        if ($w >= 250 && $h >= 200) {
            $imge = $src;
            return $imge;
        }
    }
}
}
$summ = '<table width="120%" align="center">
    <tr>
        <td>
            <img src="' . $imge . '" width="150px" height="150px" />
        </td>
        <td>
            <table>
                <tr>
                    <td>
                        <a href="' . $PAGE_url . '" target="_blank"><h4>' . $match[1] . '</h4></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>' . $tags['description'] . '</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>';
echo $summ;
?>
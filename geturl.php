<?php
$PAGE_url = "http://www.espncricinfo.com/the-ashes-2013-14/engine/current/match/636163.html";
$html = getHTML($PAGE_url, 10);
preg_match("/<title>(.*)<\/title>/i", $html, $match);
print_r($match);

$tags = get_meta_tags($PAGE_url);

$doc = new DOMDocument();
$doc->loadHTMLFile($PAGE_url);
$xpath = new DOMXpath($doc);

$imgs = $xpath->query("//img");

for ($i = 0; $i < $imgs->length; $i++) {
    $src1 = "";
    $img = $imgs->item($i);
    $src = $img->getAttribute("src");
    $htt = explode('http://', $src);
    $pos = count($htt);

    if ($pos == 1) {
        $domain = explode('//', $PAGE_url);
        $host_name = explode('/', $domain[1]);
        $src1 = $domain[0] . "//" . $host_name[0] . $src;
        list($w, $h) = getimagesize($src1);
        //echo $src1.'  w'.$w."  h".$h;
        if ($w >= 250 && $h >= 200) {
            $imge = $src1;
        }

        // echo $src.'<br>';
    } else {
        $src = $img->getAttribute("src");
        list($w, $h) = getimagesize($src);
        //echo $src1.'  w'.$w."  h".$h;
        if ($w >= 250 && $h >= 200) {
            $imge = $src;
            //echo $imge;
        }
    }
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
?>
<table width="50%" align="center">
    <tr>
        <td>
            <img src="<?php echo $imge; ?>" width="150px" height="150px" />
        </td>
        <td>
            <table>
                <tr>
                    <td>
                        <a href="<?php echo $PAGE_url; ?>" target="_blank"><h4><?php echo $match[1]; ?></h4></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?php echo $tags['description']; ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
 function TextAfterTag($input, $tag)
 {
        $result = '';
        $tagPos = strpos($input, $tag);

        if (!($tagPos === false))
        {
                $length = strlen($input);
                $substrLength = $length - $tagPos + 1;
                $result = substr($input, $tagPos + 1, $substrLength);
        }

        return trim($result);
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
       
//        $s2=trim($s2);
//        $s3=array();
//        $s3=explode(",",$s2);
//
//        $s4=TextAfterTag($s3[0],(':'));
//        return $s4;
//        $s4=stripslashes($s4);
//        return $s4;
 }
 $urls = expandUrlLongApi('http://t.co/K4GKZwdXCY');
 echo '<pre>';
 print_r( $urls);
 echo $urls['long-url'];
 if($urls['response_code'] == 200){
     echo $urls['long_url'];
 } else {
     
 }
?>
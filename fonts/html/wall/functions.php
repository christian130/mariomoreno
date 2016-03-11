<?php

class Functions {

    public static function getMainPageWall() {
        
    }

    public static function getUserWall() {
        
    }

    public static function addVimeoWidgets($text) {
        /* get youtube links */
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $text, $match);
        foreach ($match as $link) {

            if (@strpos($link[0], 'vimeo')) {
                $id = array_pop(explode('/', $link[0]));
                if (isset($id)) {
                    /* $curl = Functions::getCurl();
                      curl_setopt($curl, CURLOPT_URL, $link[0]);
                      $page = curl_exec($curl);
                      echo $link[0]; */
                    $html = '<iframe src="//player.vimeo.com/video/' . $id . '?portrait=0&amp;color=ffffff" width="300" height="200" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></p>';
                    $text = str_replace($link[0], $html, $text);
                }
            }
        }
        return $text;
    }

    public static function addSoundcloudWidgets($text) {
        /* get youtube links */

        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $text, $match);
        foreach ($match as $link) {


            if (@strpos($link[0], 'soundcloud')) {
                $url = 'https://api.soundcloud.com/resolve?url=' . urlencode($link[0]) . '&_status_code_map%5B302%5D=200&_status_format=json&client_id=b45b1aa10f1ac2941910a7f0d10f8e28&app_version=d50a6b87';
                $curl = Functions::getCurl();
                curl_setopt($curl, CURLOPT_URL, $url);
                $json = json_decode(curl_exec($curl));

                if (isset($json->location)) {
                    $code = explode('?', $json->location);
                    $code = $code[0];

                    $html = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . urlencode($code) . '"></iframe>';
                    $text = str_replace($link[0], $html, $text);
                }
            }
        }

        return $text;
    }

    public function addReverbnationWidgets($text) {
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $text, $match);
        foreach ($match as $link) {

            if (@strpos($link[0], 'reverbnation')) {
                $curl = Functions::getCurl();
                curl_setopt($curl, CURLOPT_URL, $link[0]);
                //echo $link[0];
                $page = curl_exec($curl);
                $player = explode('<meta name="twitter:player" content="', $page);
                $title = ''; //explode('<meta property="og:title" content="', $page);
                if (isset($page[1])) {
                    $player = explode('"', $player[1]);
                    $player = $player[0];

                    $html = '<div class="widget_iframe" style="display:inline-block;width:380px;height:104px;margin:0;padding:0;border:0;"><iframe class="widget_iframe" src="' . $player . '" width="100%" height="100%" frameborder="0" scrolling="no"></iframe><div class="footer_branding" style="margin-top:-5px;font-size:10px;font-family:Arial;"><center><a href="http://www.reverbnation.com/band-promotion/how-to-sell-music-on-itunes?utm_campaign=a_features_distribution&utm_medium=widget&utm_source=HTML5_Player&utm_content=widgetfooter_Sell music on itunes at ReverbNation.com" target="_blank" style="text-decoration:none;color:#444;"></center></div></div>' . '<p>' . $title . '</p>';
                    $text = str_replace($link[0], $html, $text);
                }
            }
        }
        return $text;
    }

    public static function addYoutubeWidgets($text) {
        /* get youtube links */
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $text, $match);
        foreach ($match as $link) {

            if (@strpos($link[0], 'youtube')) {
                $id = explode('v=', $link[0]);
                if (isset($id[1])) {

                    $curl = Functions::getCurl();
                    curl_setopt($curl, CURLOPT_URL, $link[0]);
                    $page = curl_exec($curl);
                    $description = explode('<meta name="twitter:description" content="', $page);

                    if (isset($description[1])) {
                        $description = explode('"', $description[1]);
                        $description = strip_tags($description[0]);
                        $description = explode('http', $description);
                        $description = $description[0];
                    } else {
                        $description = '';
                    }

                    $html = '<iframe width="440" height="250" src="//www.youtube.com/embed/' . $id[1] . '" frameborder="0" allowfullscreen></iframe><p>' . $description . '</p>';
                    $text = str_replace($link[0], $html, $text);
                }
            }
        }
        return $text;
    }

    public static function addMediaWidgest($text) {
        $text = Functions::addYoutubeWidgets($text);
        $text = Functions::addVimeoWidgets($text);
        $text = Functions::addSoundcloudWidgets($text);
        $text = Functions::addReverbnationWidgets($text);

        return $text;
    }

    public static function addLink($text) {
        $text = ' ' . Functions::addMediaWidgest($text);
        $links = array();
        $originalText = $text;
        $goodSigns = array('.', ' ');
        foreach ($goodSigns as $sign) {
            $text = explode($sign . 'http', $originalText);

            if (count($text) > 1) {
                foreach ($text as $key => $value) {

                    $link = explode(' ', $value);

                    if (trim($link[0]) != '') {
                        $links[] = 'http' . $link[0];
                        $links[] = 'https' . $link[0];
                    }
                }
            }
        }

        $links = array_unique($links);

        foreach ($links as $link) {
            $originalText = str_replace($link, '<a href="' . $link . '" target="_blank">' . $link . '</a>', $originalText);
        }

        return $originalText;
    }

    public static function getCurl() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_REFERER, 'http://google.pl');
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36');
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookies.txt');
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookies.txt');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        return $curl;
    }

    public static function getBetween($left, $right, $source, $offset = 1) {
        $step1 = explode($left, $source);
        if (count($step1) < 2 + $offset - 1) {
            return false;
        }
        $step2 = explode($right, $step1[1 + $offset - 1]);
        if (isset($step2[0])) {
            return trim(preg_replace('/\s\s+/', ' ', $step2[0]));
        }
        return false;
    }

    public static function trimByWords($text, $limit) {
        $return = explode('|||', wordwrap($text, $limit, "|||"));
        return $return[0];
    }

    public static function getUrlData() {
        $curl = Functions::getCurl();
        curl_setopt($curl, CURLOPT_URL, trim($_POST['url']));
        $page = curl_exec($curl);
        $status = curl_getinfo($curl);

        $domain = explode('//', $_POST['url']);
        $domainWithoutProtocol = explode('/', $domain[1]);
        $domain = implode('//', array($domain[0], $domainWithoutProtocol[0]));

        if ($status['http_code'] == 200) {
            /* get title */
            $title = Functions::getBetween('<title>', '</title>', $page);

            if (!$title) {
                $title = $_POST['url'];
            }
            /* get description */

            $description = explode('"description"', $page);
            if (count($description) > 1) {
                $description = explode('>', $description[1]);
                $description = Functions::trimByWords(Functions::getBetween('"', '"', $description[0]), 200);
            }

            if (!$description) {
                $description = Functions::trimByWords(strip_tags($page), 200);
            }
            /* get images */
            $images = array();
            $imagesHtml = explode('<img', $page);

            foreach ($imagesHtml as $key => $value) {

                if (($src = Functions::getBetween('src="', '"', $value))) {
                    /* @todo: add domain if not present */


                    $allowed_types = array('png', 'jpg', 'jpeg', 'gif');
                    $ext = array_pop(explode('.', $src));

                    if (in_array($ext, $allowed_types)) {

                        if (!strpos(' ' . $src, 'http') > 0) {
                            $src = str_replace('//', '/', $domain . '/' . $src);
                        }
                        $images[] = $src;
                    }
                }
            }

            $images = array_merge(array_unique($images), array());

            echo json_encode(array('title' => $title, 'description' => $description, 'images' => $images));
        }
    }

    public static function getViewData() {
        $html = file_get_contents($_POST['url']);
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        foreach ($doc->getElementsByTagName('meta') as $meta) {

            if ($meta->getAttribute('property') == 'og:image') {
                $image = $meta->getAttribute('content');
            }
            if ($meta->getAttribute('property') == 'og:title') {
                $title = $meta->getAttribute('content');
            }
            if ($meta->getAttribute('property') == 'og:description') {
                $description = $meta->getAttribute('content');
            }
            $meta->getAttribute('property');
            $meta->getAttribute('content');
        }
        echo json_encode(array('title' => $title, 'description' => $description, 'images' => $image));
    }

}

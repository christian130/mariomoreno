<?php
//$PAGE_url = "http://www.espncricinfo.com/new-zealand-v-india-2014/content/current/story/715055.html";
//$PAGE_url = "https://soundcloud.com/i-am-icon/changes?utm_source=soundcloud&utm_campaign=share&utm_medium=twitter";

$PAGE_url = "http://instagram.com/p/kFCrk_xx5M/#";
$html = file_get_contents($PAGE_url);
$doc = new DOMDocument();
$doc->loadHTML($html);
echo '<pre>';
foreach ($doc->getElementsByTagName('meta') as $meta) {
    $metaData[] = array(
        'property' => $meta->getAttribute('property'),
        'content' => $meta->getAttribute('content')
    );
}
//echo $doc->getElementsByTagName('meta')->getAttribute('property');
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

print_r($metaData);
die();
$data = file_get_contents($PAGE_url);
$pattern = '/src=[\”‘]?[""]([^\”‘]?.*(png|jpg|gif))[\”‘]?/i';
preg_match_all($pattern, $data, $images);
for ($i = 0; $i < count($images[1]); $i++) {
    $src = $images[1][$i];
    $htt = explode('http://', $src);
    $pos = count($htt);
    $handle = fopen($src, 'r');
    if ($pos == 1) {
        $domain = explode('//', $PAGE_url);
        $host_name = explode('/', $domain[1]);
        $src1 = $domain[0] . "//" . $host_name[0] . $src;

        $image = imagecreatefromjpeg($src1);
        $orig_width = imagesx($image);
        $orig_height = imagesy($image);
        echo $orig_width . " " . $orig_height;
        //list($w, $h)
//        echo $src1;
//         $size = getimagesize($src1);
//         echo $size;
//         print_r($size);
//         exit;
        if ($w >= 250 && $h >= 200) {
            $imge = $src1;
        }
    } else {
        list($w, $h) = getimagesize($src);
        if ($w >= 250 && $h >= 200) {
            $imge = $src;
        }
    }
}
echo $imge;
?>

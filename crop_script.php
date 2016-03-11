<?php

require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
require_once 'model/Profile.php';
// You destination directory (i.e) images are to be stored here
$upload_directory = "uploads";
//The full path to the image will be saved
$upload_directory_path = $upload_directory . "/";
// The prefix name to large images
$l_img_prefix = '';
// Here you can prefix for the cropped image name
$thb_image_prefix = "thumb_";
// New name of the large image (append the timestamp to the filename)	
$l_img_name = $l_img_prefix . $_POST['filename'];
// New name of the thumbnail image (append the timestamp to the filename)
$thb_image_name = $thb_image_prefix . $_POST['filename'];
// Width of thumbnail image
$thb_width = "456";
// Height of thumbnail image
$thb_height = "456";
$l_img_location = $upload_directory_path . $l_img_name;
$thb_img_location = $upload_directory_path . $thb_image_name;
$session = new Session();
if ($_POST['action'] === 'noimage') {
    $data1 = array("user_id" => $session->getSession("sign_uid"));
    $result = Signup::firstlogin($data1, $entityManager);
    if (count($result) != 0) {
        $datas = array("userid" => $result[0]['user_id']);
        $credientials = Signup::getTokens($datas, $entityManager);
        $lst = Signup::lastLogin($result[0]['user_id'], $entityManager);
        $session = new Session();
        $usrData = array(
            "user_id" => $result[0]['user_id'],
            "ipaddress" => $_SERVER['REMOTE_ADDR'],
            "login_date" => date("l, F j, Y, g:i:s A"),
            "device" => $_SERVER['HTTP_USER_AGENT']
        );
        Profile::setUserActivity($usrData, $entityManager);

        foreach ($credientials as $tokens) {
            $session->setSession($tokens['networkname'], 1);
            $session->setSession("screen_name_" . $tokens['networkname'], $tokens['screen_name']);
            $session->setSession("screen_id_" . $tokens['networkname'], $tokens['screen_id']);
            $session->setSession("auth_token_" . $tokens['networkname'], $tokens['auth_token']);
            $session->setSession("auth_secret_" . $tokens['networkname'], $tokens['auth_secret']);
        }
        $session->setSession("userid", $result[0]['user_id']);
        $session->setSession("email", $result[0]['email']);
        $session->setSession("firstname", $result[0]['firstname']);
        $session->setSession("lastname", $result[0]['lastname']);
        $session->setSession("gender", $result[0]['gender']);
        $session->setSession("dob", $result[0]['dob']);
        $session->setSession("current_city", $result[0]['current_city']);
        $session->setSession("home_city", $result[0]['home_city']);
        if ($result[0]['profile_pic'] != "") {
            $session->setSession("profile_pic", $result[0]['profile_pic']);
        }
        //  header("Location:home.php");
    }
} else {
    if (isset($thb_image_name) && $thb_image_name != "") {
        $data = array("image" => $thb_image_name,
            "sign_uid" => $session->getSession("sign_uid")
        );

        $result = Signup::signup3($data, $entityManager);
        $data1 = array("user_id" => $result);
        $result = Signup::firstlogin($data1, $entityManager);
        if (count($result) != 0) {
            $datas = array("userid" => $result[0]['user_id']);
            $credientials = Signup::getTokens($datas, $entityManager);
            $lst = Signup::lastLogin($result[0]['user_id'], $entityManager);
            $session = new Session();
            $usrData = array(
                "user_id" => $result[0]['user_id'],
                "ipaddress" => $_SERVER['REMOTE_ADDR'],
                "login_date" => date("l, F j, Y, g:i:s A"),
                "device" => $_SERVER['HTTP_USER_AGENT']
            );
            Profile::setUserActivity($usrData, $entityManager);

            foreach ($credientials as $tokens) {
                $session->setSession($tokens['networkname'], 1);
                $session->setSession("screen_name_" . $tokens['networkname'], $tokens['screen_name']);
                $session->setSession("screen_id_" . $tokens['networkname'], $tokens['screen_id']);
                $session->setSession("auth_token_" . $tokens['networkname'], $tokens['auth_token']);
                $session->setSession("auth_secret_" . $tokens['networkname'], $tokens['auth_secret']);
            }
            $session->setSession("userid", $result[0]['user_id']);
            $session->setSession("email", $result[0]['email']);
            $session->setSession("firstname", $result[0]['firstname']);
            $session->setSession("lastname", $result[0]['lastname']);
            $session->setSession("gender", $result[0]['gender']);
            $session->setSession("dob", $result[0]['dob']);
            $session->setSession("current_city", $result[0]['current_city']);
            $session->setSession("home_city", $result[0]['home_city']);
            if ($result[0]['profile_pic'] != "") {
                $session->setSession("profile_pic", $result[0]['profile_pic']);
            }
            //  header("Location:home.php");
        }
    }
    if (isset($_POST["filename"]) && file_exists($l_img_location)) {
        //Get the new coordinates to crop the image.
        $x1 = $_POST["x1"];
        $y1 = $_POST["y1"];
        $x2 = $_POST["x2"];
        $y2 = $_POST["y2"];
        $w = $_POST["w"];
        $h = $_POST["h"];
        //Scale the image to the thumb_width set above
        $scale = $thb_width / $w;
        $cropped = resizeThumbnailImage($thb_img_location, $l_img_location, $w, $h, $x1, $y1, $scale);
    }
}

function resizeThumbnailImage($thb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);

    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
    switch ($imageType) {
        case "image/gif":
            $source = imagecreatefromgif($image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            $source = imagecreatefromjpeg($image);
            break;
        case "image/png":
        case "image/x-png":
            $source = imagecreatefrompng($image);
            break;
    }
    imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
    switch ($imageType) {
        case "image/gif":
            imagegif($newImage, $thb_image_name);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            imagejpeg($newImage, $thb_image_name, 90);
            break;
        case "image/png":
        case "image/x-png":
            imagepng($newImage, $thb_image_name);
            break;
    }
    chmod($thb_image_name, 0777);
    return $thb_image_name;
}
?>
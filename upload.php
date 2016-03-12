<?php

/*
 * @author Manish Jangir
 * @website blogaddition.com
 * @script upload cropped image
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
require_once 'model/Profile.php';

function get_virtual_img($mime, $temp_file) {
    $vir_img_arr = array();
    switch ($mime) {
        case 'image/jpg':
            $ext = '.jpg';
            // create a new image from file
            $vir_img = @imagecreatefromjpeg($temp_file);
            break;

        case 'image/jpeg':
            $ext = '.jpeg';
            // create a new image from file
            $vir_img = @imagecreatefromjpeg($temp_file);
            break;

        case 'image/png':
            $ext = '.png';
            // create a new image from file
            $vir_img = @imagecreatefrompng($temp_file);
            break;

        case 'image/gif':
            $ext = '.gif';
            // create a new image from file
            $vir_img = @imagecreatefromgif($temp_file);
            break;
        default:
            @unlink($temp_file);
            return;
    }
    $vir_img_arr['ext'] = $ext;
    $vir_img_arr['img'] = $vir_img;
    return $vir_img_arr;
}

function uploadImageFile() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        /* Configuration part */
        extract($_POST);
        $desired_width = 200; //desired image result width
        $desired_height = 200; //desired image result height
        $img_quality = 100;
        $upload_dir = 'uploads/';

        if ($_FILES) {
            $file = $_FILES['image_file'];
            if (!$file['error'] && $file['size'] < 350 * 1024) {
                if (is_uploaded_file($file['tmp_name'])) {

                    // unique name of the file
                    $nam = uniqid();
                    $temp_file = $upload_dir .$nam;

                    // upload the file in appropriate folder
                    move_uploaded_file($file['tmp_name'], $temp_file);

                    @chmod($temp_file, 0644);

                    //Again check if the file was uploaded properly without any error
                    if (file_exists($temp_file) && filesize($temp_file) > 0) {
                        $file_size_arr = getimagesize($temp_file); // get the image detail
                        if (!$file_size_arr) {
                            @unlink($temp_file); //if file size array not exits then delete it
                            return;
                        }
                        $mime = $file_size_arr['mime'];
                        $virtual_img_arr = get_virtual_img($mime, $temp_file);
                        $virtual_img = $virtual_img_arr['img'];
                        $virtual_img_ext = $virtual_img_arr['ext'];
                        // create a new true color image
                        $true_color_img = @imagecreatetruecolor($desired_width, $desired_height);

                        // copy and resize part of an image with resampling
                        imagecopyresampled($true_color_img, $virtual_img, 0, 0, (int) $x1, (int) $y1, $desired_width, $desired_height, (int) $w, (int) $h);

                        // define a result image filename
                        $result = $nam . $virtual_img_ext;

                        // upload resultant file to the folder
                        imagejpeg($true_color_img, $upload_dir.$result, $img_quality);
                        @unlink($temp_file); //delete the main temporary uploaded file

                        return $result;
                    }
                }
            }
        }
    }
}

$cropped_img = uploadImageFile();
$session = new Session();
if (isset($cropped_img) && $cropped_img != "") {
    $data = array("image" => $cropped_img,
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
        header("Location:home.php");
    }
}
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Twitter
 *
 * @author admin
 */
require_once "bootstrap.php";

class Twitter {

    public function __construct() {

    }

    static public function getAllTwitterAccounts($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT a FROM AddToken a WHERE a.user_id = ?1 and a.networkname = ?2";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data['userid']);
            $query->setParameter(2, "twitter");
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function getAllTwitterActive($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT a FROM AddToken a WHERE a.user_id = ?1 and a.screen_id = ?2";
            $query = $entityManager->createQuery($dql);
            $query->setResultCacheId('my_custom_id');
            $query->useResultCache(true, 3600, 'my_custom_id');
            $query->setParameter(1, $data['userid']);
            $query->setParameter(2, $data['screen_id']);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function deleteAccount($account_id, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "Delete AddToken a WHERE a.token_id = ?1";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $account_id);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function getTwitterValidation($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT a FROM AddToken a WHERE a.screen_id = ?1 and a.user_id = ?2";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data['screen_id']);
            $query->setParameter(2, $data['user_id']);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function getHTML($url, $timeout) {
        $ch = curl_init($url); // initialize curl with given url
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
        curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
        return @curl_exec($ch);
    }

    static public function expandUrlLongApi($url) {
        $format = 'json';
        $api_query = "http://api.longurl.org/v2/expand?url={$url}&response-code=1&format={$format}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $fileContents = curl_exec($ch);
        curl_close($ch);
        $s1 = str_replace("{", " ", "$fileContents");
        $s2 = str_replace("}", " ", "$s1");
        return json_decode($fileContents, true);
    }

    static public function getImageName($PAGE_url) {
        $data = file_get_contents($PAGE_url);
        $pattern = '/src=[\”‘]?[""]([^\”‘]?.*(png|jpg|gif))[\”‘]?/i';
        preg_match_all($pattern, $data, $images);
        for ($i = 0; $i < 10; $i++) {
            $src = $images[1][$i];
            $htt = explode('http://', $src);
            $pos = count($htt);

            if ($pos == 1) {
                $domain = explode('//', $PAGE_url);
                $host_name = explode('/', $domain[1]);
                $src1 = $domain[0] . "//" . $host_name[0] . $src;
                list($w, $h) = getimagesize($src1);
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
    }

}
?>

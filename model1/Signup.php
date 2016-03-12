<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Signup
 *
 * @author sathish
 */
require_once "bootstrap.php";

class Signup {

    protected $res;

    //put yor code here
    public function __construct() {
        
    }

    static public function generateRandomString() {
        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = str_shuffle($characters);
        return substr($characters, 0, $length);
    }

    static public function save($data, $entityManager) {
        session_start();
        $register = new UserRegister();
        $activation = Signup::generateRandomString();
        $dob = $data['year'] . '-' . $data['month'] . '-' . $data['day'];
        $register->setFirstName($data['firstname']);
        $register->setLastName($data['lastname']);
        $register->setEmail($data['email']);
        $register->setPassword(md5($data['password']));
        $register->setPhoto($photo);
        $register->setActivation($activation);
        $register->setDOB(new DateTime($dob));
        $register->setRegStatus("PENDING");
        $register->setSignupDate(new DateTime());
        $register->setSessionId(session_id());
        $register->setGender($data['gender']);
        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($register);
            SendMail::sendRegisterationMail($register->getEmail(), $register->getActivation(), $register->getFirstName(), $register->getLastName());
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            return $register->getUser_id();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function signup2($data, $entityManager) {
        session_start();
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.current_city = :cCity,r.home_city=:hCity WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'cCity' => $data['current_city_id'],
                'hCity' => $data['home_city_id'],
                'sUid' => $data['sign_uid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileEdit($data, $entityManager) {
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r." . $data['id'] . " = :iValue WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'iValue' => $data['value'],
                'sUid' => $data['userid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileEditBasicinfo($data, $entityManager) {
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.firstname = :firstname,r.lastname =:lastname"
                    . ",r.current_city = :current_city_id,r.home_city = :home_city_id,r.interested = :interested"
                    . ",r.relationship = :relationship,r.politicalview = :politicalview,r.religion = :religion,r.language =:language"
                    . " WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                "firstname" => $data['firstname'],
                "lastname" => $data['lastname'],
                "current_city_id" => $data['current_city_id'],
                "home_city_id" => $data['home_city_id'],
                "interested" => $data['interested'],
                "relationship" => $data['relationship'],
                "politicalview" => $data['politicalview'],
                "religion" => $data['religion'],
                "language" => $data['language'],
                "sUid" => $data['userid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileEditAboutyou($data, $entityManager) {
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.aboutyou = :aboutyou,r.listinterest =:listinterest WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'aboutyou' => $data['aboutyou_p'],
                'listinterest' => $data['listinterest'],
                'sUid' => $data['userid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileEditContact($data, $entityManager) {
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.phonenumber = :phonenumber WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'phonenumber' => $data['phonenumber'],
                'sUid' => $data['userid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileView($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT b FROM UserRegister b WHERE b.user_id = ?1";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data['userid']);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function signup3($data, $entityManager) {
        session_start();
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.profile_pic = :iImage WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'iImage' => $data['image'],
                'sUid' => $data['sign_uid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function addCities($data, $entityManager) {
        session_start();
        $location = new Location();
        $location->setCountry($data['country']);
        $location->setCity($data['city']);
        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($location);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            return $location->getId();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function allCountry($entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT l FROM Location l group by l.country";
            $query = $entityManager->createQuery($dql);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function getCities($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT l FROM Location l WHERE l.city LIKE :search AND l.country = ?2";
            $query = $entityManager->createQuery($dql);
            $query->setParameter('search', $data['text'] . '%');
            $query->setParameter(2, $data['country']);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function validate($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT b FROM UserRegister b WHERE b.email = ?1";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function login($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT b FROM UserRegister b WHERE b.email = ?1 AND b.password = ?2";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data['login_username']);
            $query->setParameter(2, $data['login_password']);
            $user_id = $query->getArrayResult();
            return $user_id;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function lastLogin($user_id, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.last_login = :iLastLogin WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'sUid' => $user_id,
                'iLastLogin' => date("l, F j, Y, g:i:s A")
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function addToken($data, $entityManager) {
        $addToken = new AddToken();
        $addToken->setNetworkName($data['networkname']);
        $addToken->setAuthToken($data['auth_token']);
        $addToken->setAuthSecret($data['auth_secret']);
        $addToken->setUserId($data['user_id']);
        $addToken->setScreenName($data['screen_name']);
        $addToken->setScreenID($data['screen_id']);
        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($addToken);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            return $addToken->getTokenId();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function getTokens($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT a FROM AddToken a WHERE a.user_id = ?1";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data['userid']);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function getTown($data, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT l FROM Location l where l.id =?1";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data);
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileEditwork($data, $entityManager) {
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.work = :work,r.education = :education WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'work' => $data['work'],
                'education' => $data['education'],
                'sUid' => $data['userid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function profileEditcover($data, $entityManager) {
        $register = new UserRegister();
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "UPDATE UserRegister r set r.cover_photo = :cover_photo WHERE r.user_id =:sUid";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'cover_photo' => $data['cover_photo'],
                'sUid' => $data['userid']
            ));
            $query->getResult();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    static public function checkusername($data1, $entityManager) {
        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT b FROM UserRegister b WHERE b.email = ?1";
            $query = $entityManager->createQuery($dql);
            $query->setParameter(1, $data1['login_username']);
            $user_id = $query->getArrayResult();
            return $user_id;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

}
?>
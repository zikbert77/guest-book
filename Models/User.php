<?php
namespace Models;

include ROOT.'/Core/Model.php';

use Core\Model;

class User extends Model
{


    public static function checkEmailExist( $email )
    {
        $stmt = self::$statdb->prepare('SELECT user_id FROM users WHERE email = :email');
        $result = $stmt->execute(array('email' => $email));

        $email = $stmt->rowCount();

        if ( $email != 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public  function checkUsernameExist( $username )
    {
        $stmt = $this->db->prepare('SELECT user_id FROM users WHERE username = :username');
        $result = $stmt->execute(array('username' => $username));

        $uname = $stmt->rowCount();
        if ( $uname != 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserAgent()
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];

        if (strpos($user_agent, "Firefox") !== false)
            $browser = "Firefox";
        elseif (strpos($user_agent, "Opera") !== false)
            $browser = "Opera";
        elseif (strpos($user_agent, "Chrome") !== false)
            $browser = "Chrome";
        elseif (strpos($user_agent, "MSIE") !== false)
            $browser = "Internet Explorer";
        elseif (strpos($user_agent, "Safari") !== false)
            $browser = "Safari";
        else $browser = "Undefined";

        return $browser;
    }

    public static function getUserNameById( $id )
    {
        $stmt = self::$statdb->prepare('SELECT username FROM users WHERE user_id = :user_id');
        $stmt->execute(array('user_id' => $id));

        $username = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ( $username ) {
            return $username['username'];
        } else {
            return null;
        }
    }

    public static function getEmailByUserName( $username )
    {
        $stmt = self::$statdb->prepare('SELECT user_id FROM users WHERE username = :username');
        $stmt->execute(array('username' => $username));

        $user_id = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ( $user_id ) {
            return $user_id['user_id'];
        } else {
            return null;
        }
    }

    public static function getEmailById( $id )
    {
        $stmt = self::$statdb->prepare('SELECT email FROM users WHERE user_id = :user_id');
         $stmt->execute(array('user_id' => $id));

        $email = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ( $email ) {
            return $email['email'];
        } else {
            return null;
        }
    }

    public function getInfo()
    {
        $user_id = (isset($_SESSION['user_id']))? $_SESSION['user_id'] : null;

        $stmt = $this->db->prepare('SELECT username, email FROM users WHERE user_id = :user_id');
        $result = $stmt->execute(array('user_id' => $user_id));
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return $user;
        } else {
            return false;
        }
    }

    public function getIp()
    {
        if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) )
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function login( $userInfo )
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username AND password = :password AND stat_id <> :stat_id ');
        $result = $stmt->execute(array('username' => $userInfo['username'], 'password' => $userInfo['password'], 'stat_id' => 2));
        $user = $stmt->fetch();
        if ($result) {


            //Check than user is admin
            if ( $user['stat_id'] == 3 )
                $_SESSION['is_admin'] = 1;
            else
                $_SESSION['is_admin'] = 0;


            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['username'];

            $this->saveUserInfo($user['user_id']);

            return true;
        } else {
            return false;
        }
    }

    public function register( $userInfo )
    {
        $stmt = $this->db->prepare('INSERT INTO users( email, username, password ) VALUES( :email, :username, :password )');
        $result = $stmt->execute(array('email' => $userInfo['email'],'username' => $userInfo['username'], 'password' => $userInfo['password1']));
        $userId = $this->db->lastInsertId();

        $stmt1 = $this->db->prepare('INSERT INTO users_info( ip, browser, user_id) VALUES ( :ip, :browser, :user_id )');
        $stmt1->execute(array('ip' => $this->getIp(), 'browser' => $this->getUserAgent(), 'user_id' => $userId));

        if ($result) {

            return $userId;
        } else {
            return null;
        }
    }

    public function saveUserInfo ( $userId )
    {
        $user_agent = $this->getUserAgent();

        $user_ip = $this->getIp();

        $stmt = $this->db->prepare('UPDATE users_info SET ip = :ip, browser = :browser WHERE user_id = :user_id');
        $stmt->execute(array('ip' => $user_ip, 'browser' => $user_agent, 'user_id' => $userId));

    }

    public static function updatePass ( $username, $password )
    {
        $stmt = self::$statdb->prepare('UPDATE `users` SET password = :password WHERE username = :username ');
        $result = $stmt->execute(array('username' => $username, 'password' => $password));

        if ($result) {

            return true;
        } else {
            return false;
        }
    }


}
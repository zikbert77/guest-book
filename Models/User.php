<?php
namespace Models;

include ROOT.'/Core/Model.php';

use Core\Model;

class User extends Model
{


    public function checkEmailExist($email)
    {
        $stmt = $this->db->prepare('SELECT user_id FROM users WHERE email = :email');
        $result = $stmt->execute(array('email' => $email));

        $email = $stmt->rowCount();

        if ( $email != 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUsernameExist($username)
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

    public static function getUserNameById( $id )
    {
        $stmt = self::$statdb->prepare('SELECT username FROM users WHERE user_id = :user_id');
        $result = $stmt->execute(array('user_id' => $id));

        $username = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ( $username ) {
            return $username['username'];
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

    public function login($userInfo)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $result = $stmt->execute(array('username' => $userInfo['username'], 'password' => $userInfo['password']));
        $user = $stmt->fetch();
        if ($result) {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['username'];
            header("Location: /user/{$user['user_id']}");

            return true;
        } else {
            return false;
        }
    }

    public function register($userInfo)
    {
        $stmt = $this->db->prepare('INSERT INTO users( email, username, password ) VALUES( :email, :username, :password )');
        $result = $stmt->execute(array('email' => $userInfo['email'],'username' => $userInfo['username'], 'password' => $userInfo['password1']));
        $userId = $this->db->lastInsertId();
        if ($result) {

            return $userId;
        } else {
            return null;
        }
    }


}
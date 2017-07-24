<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 22.07.2017
 * Time: 7:46
 */

namespace Controllers;

include_once ROOT . '/Core/Controller.php';
include_once ROOT.'/Models/User.php';

use Core\Controller;
use Models\User;



class AuthController extends Controller
{
    public function getLogin()
    {

        $this->translate();

        if ( !$this->checkLogin() ) {

            /*Log in procedure*/

            if ( isset($_POST['login']) ) {

                if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                    $this->errors[] = CAPTCHA_ERROR;


                if ( !$this->errors ) {

                    $login['username'] = trim(strip_tags(htmlspecialchars($_POST['username'])));
                    $login['password'] = md5($_POST['pass']);

                    $user = new User();
                    $user->login($login);
                }


            }

            $this->view('login_page');
        } else {
            $this->redirect( '/' );
        }
        return true;
    }

    public function logOut(){
        if ( $this->checkLogin() ) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            $this->redirect( '/' );
        }
        return true;
    }

    public function registerUser()
    {

        $this->translate();

        if ( !$this->checkLogin() ) {

            /*Register procedure*/

            if ( isset($_POST['register']) ) {

                $user = new User();

                $register['username'] = trim(strip_tags(htmlspecialchars($_POST['username'])));
                $register['password1'] = $_POST['pass1'];
                $register['password2'] = $_POST['pass2'];
                $register['email'] = trim(strip_tags(htmlspecialchars($_POST['email'])));

                /*Валідація полів*/
                if ( User::checkEmailExist($register['email']) )
                    $this->errors[] = "Така електронна адреса існує";

                if ( ! preg_match('/^[a-z0-9_-]{3,16}$/', $register['username']) )
                    $this->errors[] = USERNAME_ERROR;

                if ( ! preg_match('/^[a-z0-9_-]{6,18}$/', $register['password1']) )
                    $this->errors[] = PASSWORD_ERROR;

                if ( strlen($register['username']) < 3 || strlen($register['username']) > 16)
                    $this->errors[] = USERNAME_LENGTH_ERROR;

                if ( strlen($register['password1']) < 6 || strlen($register['password1']) > 18)
                    $this->errors[] = PASSWORD_LENGTH_ERROR;

                if ( User::checkUsernameExist($register['username']) )
                    $this->errors[] = USERNAME_EXIST;

                if ( !filter_var($register['email'], FILTER_VALIDATE_EMAIL) )
                    $this->errors[] = EMAIL_ERROR;

                if ( $register['password1'] !== $register['password2'] )
                    $this->errors[] = PASSWORD_NOT_MATCH;

                if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                    $this->errors[] = CAPTCHA_ERROR;


                if ( !$this->errors ) {

                    $register['password1'] = md5($register['password1']);

                    $userId = $user->register($register);

                    if ( $userId != null ) {
                        $this->redirect("/login");
                    } else {
                        die("Error");
                        exit();
                    }

                }


            }

            $this->view('register_page');
        } else {
            $this->redirect( '/' );
        }
        return true;
    }
}
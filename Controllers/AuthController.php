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
    public function forgotPass ()
    {
        $this->translate();

        if ( !$this->checkLogin() ) {

            if ( isset( $_POST['forgot'] ) ) {

                $username = trim(strip_tags(htmlspecialchars($_POST['username'])));
                $user = new User();

                if ( ! $user->checkUsernameExist( $username ) )
                    $this->errors[] = USERNAME_NOT_EXIST;

                if ( ! $this->errors ) {

                    $email = User::getEmailByUserName( $username );

                    $newPass = '';
                    $string = '';

                    $simvols = array ("0","1","2","3","4","5","6","7","8","9",
                        "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
                        "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

                    for ( $key = 0; $key < 6; $key++ ) {

                        shuffle ( $simvols );
                        $string = $string.$simvols[1];

                    }

                    $newPass = md5($string);

                    if ( User::updatePass( $username, $newPass ) ) {

                        $msg = FORGOT_PASSWORD . ' : ' . $username . "<br>New pass : " . $string;
                        mail( $email, FORGOT_PASSWORD, $msg );

                        $this->redirect('/success');
                        return true;

                    } else {

                        $this->redirect('/false');
                        return false;
                    }

                }

            }




            $this->view('forgot_page');
        }

        return true;
    }

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

                    $login = $user->login($login);

                    if ( ! $login ) {

                        $this->errors[] = LOGIN_ERROR_OR_BLOCKED;
                        $this->redirect( '/', 2 );

                        return false;

                    }

                    $this->redirect( '/');

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
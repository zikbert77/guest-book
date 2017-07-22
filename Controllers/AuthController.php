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

        if ( !$this->checkLogin() ) {

            /*Log in procedure*/

            if ( isset($_POST['login']) ) {

                if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                    $this->errors[] = "Невірно введено капчу!";


                if ( !$this->errors ) {

                    $login['username'] = trim(htmlspecialchars($_POST['username']));
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
            $this->redirect( '/' );
        }
        return true;
    }

    public function registerUser()
    {
        if ( !$this->checkLogin() ) {

            /*Register procedure*/

            if ( isset($_POST['register']) ) {

                $user = new User();

                $register['username'] = trim(htmlspecialchars($_POST['username']));
                $register['password1'] = md5($_POST['pass1']);
                $register['password2'] = md5($_POST['pass2']);
                $register['email'] = $_POST['email'];

                /*Валідація полів*/
                if ( $user->checkEmailExist($register['email']) )
                    $this->errors[] = "Така електронна адреса існує";

                if ( $user->checkUsernameExist($register['username']) )
                    $this->errors[] = "Таке ім'я користувача уже зареєстровано";

                if ( !filter_var($register['email'], FILTER_VALIDATE_EMAIL) )
                    $this->errors[] = "Некоректно введено елеутронну адресу";

                if ( $register['password1'] !== $register['password2'] )
                    $this->errors[] = "Паролі не співпадають";

                if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                    $this->errors[] = "Невірно введено капчу!";


                if ( !$this->errors ) {

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
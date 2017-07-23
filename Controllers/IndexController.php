<?php

namespace Controllers;

include_once ROOT . '/Core/Controller.php';
include_once ROOT . '/Core/Pagination.php';
include_once ROOT . '/Models/User.php';
include_once ROOT . '/Models/Message.php';
include_once ROOT . '/Models/Tech.php';

use Core\Controller;
use Core\Model;
use Core\Pagination;
use Models\Message;
use Models\Tech;
use Models\User;


class IndexController extends Controller
{

    public function main ()
    {


        $this->redirect("/page-1");
        return true;
    }

    public function show ( $page = 1, $sort = false )
    {

        $this->translate();

        $messsage = new Message();
        $msgs = $messsage->getAllMessages( $sort, $page );

        $countMsgs = $messsage->getCountMessages();

        $pagination = new Pagination($countMsgs, $page, SHOW_PER_PAGE, 'page-');

        require_once ROOT . '/Views/main.php';
        return true;
    }

    public function addMessage (  )
    {
            $this->translate();

            if( $this->checkLogin() ) {

                $user = new User;
                $user = $user->getInfo();

                if ( isset($_POST['add-message']) ) {

                    $msg['username'] = $_POST['username'];
                    $msg['user_id'] = $_SESSION['user_id'];
                    $msg['email'] = $_POST['email'];
                    $msg['homepage'] = stripslashes(htmlspecialchars($_POST['url']));
                    $msg['text'] = stripslashes(htmlspecialchars(strip_tags($_POST['text'])));
                    $msg['lang'] = $_SESSION['lang'];

                    if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                        $this->errors[] = CAPTCHA_ERROR;

                    if( !( preg_match( "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $msg['homepage'] ) ) )
                        $this->errors[] = URL_ERROR;

                    if ( !$this->errors ) {

                        $message = new Message();
                        $result = $message->addMessage( $msg );

                        if ( $result ) {

                            $success = true;
                            $this->redirect('/');

                        }

                    }


                }
            }

        require_once ROOT . '/Views/add-message.php';
        return true;
    }

    public function changeLang (  )
    {

        $newLang = ( isset( $_GET['lang'] ) )? $_GET['lang'] : $_SESSION['lang'];

        if ( Tech::checkLangExists( $newLang ) ) {

            $_SESSION['lang'] = $newLang;

        }
        return $_SESSION['lang'];
    }


}
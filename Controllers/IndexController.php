<?php

namespace Controllers;

include_once ROOT . '/Core/Controller.php';
include_once ROOT . '/Models/User.php';
include_once ROOT . '/Models/Message.php';

use Core\Controller;
use Core\Model;
use Models\Message;
use Models\User;


class IndexController extends Controller
{

    public function show()
    {
        $messsage = new Message();
        $msgs = $messsage->getAllMessages();


        require_once ROOT . '/Views/main.php';
        return true;
    }

    public function addMessage()
    {

            if( $this->checkLogin() ) {

                $user = new User;
                $user = $user->getInfo();

                if ( isset($_POST['add-message']) ) {

                    $msg['username'] = $_POST['username'];
                    $msg['user_id'] = User::getEmailByUserName($msg['username']);
                    $msg['email'] = $_POST['email'];
                    $msg['homepage'] = $_POST['url'];
                    $msg['text'] = $_POST['text'];

                    if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                        $this->errors[] = "Невірно введено капчу!";


                    if ( !$this->errors ) {

                        $message = new Message();
                        $result = $message->addMessage($msg);

                        if ( $result ) {

                            $success = true;
                            $this->redirect('/', 3);

                        }

                    }


                }
            }

        require_once ROOT . '/Views/add-message.php';
        return true;
    }
}
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

        if ( $this->checkLogin() ){
            $this->view('add-message');
        } else {
            $this->redirect( '/login' );
        }

        return true;
    }
}
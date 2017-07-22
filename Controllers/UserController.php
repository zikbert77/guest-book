<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 21.07.2017
 * Time: 20:26
 */

namespace Controllers;

include_once ROOT . '/Core/Controller.php';
include_once ROOT.'/Models/User.php';

use Core\Controller;
use Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        if ( !$this->checkLogin() )
            $this->redirect('/login');
    }

    public function userPage(){

        $this->view('user_cabinet');
        return true;
    }

}
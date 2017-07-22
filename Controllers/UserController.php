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

    public function userPage(){

        echo $_SESSION['user_name'];
        return true;
    }

}
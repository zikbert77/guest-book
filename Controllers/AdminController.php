<?php
namespace Controllers;

use Core\Controller;
use Models\Admin;
use Models\User;

include_once ROOT . '/Core/Controller.php';
include_once ROOT . '/Models/Admin.php';

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 21.07.2017
 * Time: 14:40
 */
class AdminController extends Controller
{
    public function main ()
    {

        $this->translate();

        if ( $this->checkLogin() && $this->checkAdmin() ) {



            require_once ROOT . '/Views/admin/main.php';
        } else {

            $this->redirect('/login');

        }


        return true;
    }

    public function managing( $id )
    {

        $this->translate();

        $id = (int) $id;

        if ( $this->checkLogin() && $this->checkAdmin() ) {

            $admin = new Admin();
            $user = $admin->getUser( $id );
            $statuses = $admin->getAllStatuses();

            if ( isset( $_POST['manage'] ) ) {


                $edit['id'] = $id;
                $edit['status'] = (int) $_POST['status'];

                if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                    $this->errors[] = CAPTCHA_ERROR;


                if ( !$this->errors ) {

                    if ( $admin->manageUser( $edit ) )
                        $this->redirect('/manager/users/');

                }


            }

            require_once ROOT . '/Views/admin/managing_user.php';
        } else {

            $this->redirect( '/login' );

        }


        return true;
    }

    public function manageUsers ()
    {

        $this->translate();

        if ( $this->checkLogin() && $this->checkAdmin() ) {

            $admin = new Admin();
            $users = $admin->getAllUsers();

            require_once ROOT . '/Views/admin/managing_users.php';
        } else {

            $this->redirect('/login');

        }


        return true;
    }
}
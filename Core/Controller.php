<?php
namespace Core;

use Controllers;

class Controller
{
    public $errors = false;

    protected function checkLogin(){
        if ( isset($_SESSION['user_id']) )
            return true;
        return false;
    }

    protected function redirect( $to, $pause = false ) {

        if ( $pause ) {
            sleep( $pause );
        }

        header("Location: $to");
    }

    protected function view( $viewName )
    {
        $viewPath =  ROOT . '/Views/' . $viewName . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
            return true;
        } else {
            return false;
        }
    }
}
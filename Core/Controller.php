<?php
namespace Core;

use Controllers;
use Models\Tech;

class Controller
{

    protected $language_file = '/Languages/ukr.php';
    public $errors = false;

    protected function translate(  )
    {

        $id = $_SESSION['lang'];

        $abbr = Tech::getLangTitle( $id );

        $new_language_file = ROOT . '/Languages/'. $abbr . '.php';

        if ( file_exists( $new_language_file ) )
            include_once $new_language_file;
        else
            include_once $this->language_file;

    }

    protected function checkAdmin()
    {
        if ( isset( $_SESSION['is_admin'] ) && $_SESSION['is_admin'] == 1 )
            return true;

        return false;
    }

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
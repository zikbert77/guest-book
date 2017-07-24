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


        $this->redirect("/page-1/");
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

                    $msg['username'] = trim(strip_tags(htmlspecialchars($_POST['username'])));
                    $msg['user_id'] = $_SESSION['user_id'];
                    $msg['email'] = trim(strip_tags(htmlspecialchars($_POST['email'])));
                    $msg['homepage'] = stripslashes(htmlspecialchars($_POST['url']));
                    $msg['text'] = trim(stripslashes(htmlspecialchars(strip_tags($_POST['text']))));
                    $msg['lang'] = $_SESSION['lang'];

                    if ( $_SESSION['captcha'] != md5($_POST['captcha']) )
                        $this->errors[] = CAPTCHA_ERROR;

                    if( !( preg_match( "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $msg['homepage'] ) ) )
                        $this->errors[] = URL_ERROR;


                    //Add images
                    $image_format = $_FILES['task_image']['type'];

                    $types = ['image/png', 'image/jpeg'];

                    if(!in_array($image_format, $types)){
                        $this->errors[] = IMG_ERROR;
                    }


                    if ( !$this->errors ) {

                        $message = new Message();

                        $msg['picture'] = $this->resize($_FILES['task_image']);
                        $result = $message->addMessage( $msg );

                        $image_name = $_FILES['task_image']['tmp_name'];

                        $uploaddir = ROOT . '/msgs/' . $result;

                        if(mkdir($uploaddir, 0777)) {

                            if (file_exists($uploaddir)){
                                $uploadfile = $uploaddir . '/' . basename($msg['picture']);

                                if(!copy('msgs/tmp/'. $msg['picture'], $uploadfile)){
                                    echo IMG_UPLOAD_ERROR;
                                }
                                unlink('msgs/tmp/'. $msg['picture']);

                            }
                        }


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

        $newLang = trim(strip_tags(htmlspecialchars(( isset( $_GET['lang'] ) )? $_GET['lang'] : $_SESSION['lang'])));

        if ( Tech::checkLangExists( $newLang ) ) {

            $_SESSION['lang'] = $newLang;

        }
        return $_SESSION['lang'];
    }

    public function resize($file, $type = 1, $quality = null){

    $tmp_path = 'msgs/tmp/';

    if($quality == null)
        $quality = 75;

    if ($file['type'] == 'image/jpeg')
        $source = imagecreatefromjpeg ($file['tmp_name']);
    elseif ($file['type'] == 'image/png')
        $source = imagecreatefrompng ($file['tmp_name']);
    elseif ($file['type'] == 'image/gif')
        $source = imagecreatefromgif ($file['tmp_name']);
    else
        return false;

    $w_src = imagesx($source);
    $h_src = imagesy($source);

    $w = MAX_IMAGE_WIDTH;
    $h = MAX_IMAGE_HEIGHT;

    if($w_src > $w){
        $ratio = $w_src/$w;
        $w_dest = round($w_src/$ratio);
        $h_dest = round($h_src/$ratio);

        $dest = imagecreatetruecolor($w_dest, $h_dest);

        imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

        imagejpeg($dest, $tmp_path . $file['name'], $quality);
        imagedestroy($dest);
        imagedestroy($source);

        return $file['name'];
    } else {
        imagejpeg($source, $tmp_path . $file['name'], $quality);
        imagedestroy($source);
        return $file['name'];
    }

}


}
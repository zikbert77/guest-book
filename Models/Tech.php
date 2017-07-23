<?php
/**
 * Created by PhpStorm.
 * User: zikbert77
 * Date: 23.07.2017
 * Time: 15:30
 */

namespace Models;

use Resources\Db;

include_once ROOT . '/Resources/Db.php';

class Tech
{

    public static function getLangTitle ( $id ) {

        $conn = new Db();
        $db = $conn->getConnection();

        $stmt = $db->prepare('SELECT lang_title FROM languages WHERE lang_id = ?');
        $stmt->execute( array( $id ) );

        $title = $stmt->fetch( \PDO::FETCH_ASSOC );

        return $title['lang_title'];
    }

    public static function checkLangExists ( $lang )
    {
        $conn = new Db();
        $db = $conn->getConnection();


        $stmt = $db->prepare('SELECT lang_id FROM languages WHERE lang_id = :lang_id');
        $stmt->execute(array('lang_id' => $lang));

        $lang_title = $stmt->rowCount();
        if ( $lang_title != 0 ) {
            return true;
        } else {
            return false;
        }

    }

    public static function getAllLangs (  )
    {

        $langs = array();

        $conn = new Db();
        $db = $conn->getConnection();

        $stmt = $db->query('SELECT * FROM languages');

        $i = 0;
        while ( $row = $stmt->fetch( \PDO::FETCH_ASSOC ) ) {

            $langs[$i]['lang_id'] = $row['lang_id'];
            $langs[$i]['lang_title'] = $row['lang_title'];
            $i++;
        }

        return $langs;
    }

}
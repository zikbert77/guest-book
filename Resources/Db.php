<?php
namespace Resources;

class Db {
    
    public static function getConnection(){

        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'guest-book';

        try {

            $db = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        return $db;
        
    }
}

?>
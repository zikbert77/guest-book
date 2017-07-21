<?php

class Db {
    
    public static function getConnection(){

        $params = [
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
            'db_name' => 'guest_book',
        ];
        
        $db = new mysqli($params['host'], $params['user'], $params['pass'], $params['db_name']);
        
        return $db;
        
    }
}

?>
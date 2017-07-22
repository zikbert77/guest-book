<?php
namespace Models;

include_once ROOT.'/Core/Model.php';
include_once ROOT.'/Models/User.php';

use Core\Model;

class Message extends Model
{
    public function getAllMessages()
    {
        $messages = array();

        $stmt = $this->db->query('SELECT * FROM messages');

        $i = 0;
        while( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['text'] = $row['text'];
            $messages[$i]['homepage'] = ($row['homepage'] === '')? '-' : $row['homepage'];
            $messages[$i]['user_id'] = $row['user_id'];
            $messages[$i]['user_name'] = User::getUserNameById($row['user_id']);
            $messages[$i]['user_email'] = User::getEmailById($row['user_id']);
            $messages[$i]['date'] = $row['date'];
            $i++;
        }

        return $messages;
    }
}
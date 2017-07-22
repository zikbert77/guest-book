<?php
namespace Models;

include_once ROOT.'/Core/Model.php';
include_once ROOT.'/Models/User.php';

use Core\Model;

class Message extends Model
{
    public function addMessage ( $msg )
    {
        $msgId = null;

        $stmt = $this->db->prepare( "INSERT INTO messages ( homepage, text, user_id ) VALUES ( :url, :text, :user_id )" );
        $stmt->execute( array( 'url' => $msg['homepage'], 'text' => $msg['text'], 'user_id' => $msg['user_id'] ) );

        $msgId = $this->db->lastInsertId();

        if ( $msgId != null )
            return $msgId;

        return false;
    }

    public function getAllMessages ()
    {
        $limit_from = 0;
        $per_page = 25;

        $messages = array();

        $stmt = $this->db->prepare('SELECT * FROM messages ORDER BY date DESC LIMIT ?, ?');
        $stmt->bindParam(1, $limit_from, \PDO::PARAM_INT);
        $stmt->bindParam(2, $per_page, \PDO::PARAM_INT);
        $stmt->execute();

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
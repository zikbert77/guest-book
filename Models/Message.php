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

        $stmt = $this->db->prepare( "INSERT INTO messages ( homepage, text, user_id, username, email, lang_id ) VALUES ( :url, :text, :user_id, :username, :email, :lang_id )" );
        $stmt->execute( array( 'url' => $msg['homepage'], 'text' => $msg['text'], 'user_id' => $msg['user_id'], 'username' => $msg['username'], 'email' => $msg['email'], 'lang_id' => $msg['lang'] ) );

        $msgId = $this->db->lastInsertId();

        if ( $msgId != null )
            return $msgId;

        return false;
    }

    public function getAllMessages ( $sort, $page )
    {
        if ( $sort === 'date_asc' ) {

            $order = " ORDER BY date ASC ";

        } elseif ( $sort === 'date_desc' ) {

            $order = " ORDER BY date DESC ";

        } elseif ( $sort === 'username_desc' ) {

            $order = " ORDER BY username DESC ";

        } elseif ( $sort === 'username_asc' ) {

            $order = " ORDER BY username ASC ";

        } elseif ( $sort === 'email_desc' ) {

            $order = " ORDER BY email DESC ";

        } elseif ( $sort === 'email_asc' ) {

            $order = " ORDER BY email ASC ";

        } else {
            $order = " ORDER BY date DESC ";
        }

        $per_page = SHOW_PER_PAGE;
        $limit_from = ($page * $per_page) - $per_page;

        $order_column = ' data ';
        $order_type = ' ASC ';

        $messages = array();

        $stmt = $this->db->prepare("SELECT * FROM messages $order LIMIT ?, ?");
        $stmt->bindParam(1, $limit_from, \PDO::PARAM_INT);
        $stmt->bindParam(2, $per_page, \PDO::PARAM_INT);
        $stmt->execute();

        $i = 0;
        while( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['text'] = $row['text'];
            $messages[$i]['homepage'] = ($row['homepage'] === '')? '-' : $row['homepage'];
            $messages[$i]['user_id'] = $row['user_id'];
            $messages[$i]['user_name'] = $row['username'];
            $messages[$i]['user_email'] = $row['email'];
            $messages[$i]['date'] = $row['date'];
            $i++;
        }

        return $messages;
    }

    public function getCountMessages () {
        $stmt = $this->db->prepare("SELECT COUNT(user_id) FROM messages");
        $stmt->execute();
        $result = $stmt->fetch();

        return $result[0];
    }
}
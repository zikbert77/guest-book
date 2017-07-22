<?php
namespace Models;

include_once ROOT.'/Core/Model.php';

use Core\Model;

class Message extends Model
{
    public function get()
    {
        $stmt = $this->db->query('SELECT * FROM messages');
        $result = $stmt->fetch();

        return $result;
    }
}
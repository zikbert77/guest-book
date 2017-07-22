<?php
namespace Core;

use Resources\Db;

class Model
{
    protected $db;

    public function __construct()
    {
        $conn = new Db();
        $this->db = $conn->getConnection();
    }

}
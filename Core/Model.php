<?php
namespace Core;

use Resources\Db;

class Model
{
    protected $db;
    protected static $statdb;

    public function __construct()
    {
        $conn = new Db();
        $this->db = $conn->getConnection();

        self::$statdb = $this->db;
    }

}
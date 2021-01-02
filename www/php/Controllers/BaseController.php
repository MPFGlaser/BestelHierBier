<?php

namespace Controllers;

use Core\Database;

class BaseController
{
    public Database $db;

    public function __construct()
    {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }
}

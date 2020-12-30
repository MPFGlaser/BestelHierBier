<?php

namespace Models;

class User
{
    protected $username;
    protected $email;
    protected $admin;
    protected $id;

    function __construct($user)
    {
        $this->username = $user['UserName'];
        $this->email = $user['EMail'];
        $this->admin = $user['admin'];
        $this->id = $user['ID'];
    }
}

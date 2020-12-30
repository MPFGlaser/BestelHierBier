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
        $this->username = $user['username'];
        $this->email = $user['email'];
        $this->admin = $user['admin'];
        $this->id = $user['id'];
    }
}

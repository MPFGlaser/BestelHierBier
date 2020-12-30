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

    function get_name()
    {
        return $this->username;
    }

    function get_id()
    {
        return $this->id;
    }

    function is_admin()
    {
        return $this->admin;
    }

    function get_email(){
        return $this->_email;
    }
}

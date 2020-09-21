<?php
    class User{
        protected $_username;
        protected $_email;
        protected $_password;

        // protected $_user;

        function __construct($username, $email, $password){
            $this->_username = $username;
            $this->_email = $email;
            $this->_password = $password;
        }

        function get_name(){
            return $this->_username;
        }

        function get_password(){
            return $this->_password;
        }
    }
?>
